<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departemen;
use App\Models\Plant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
// app/Http/Controllers/UserController.php

    public function index(Request $request)
    {
    // mulai query
        $query = User::with(['plantRelasi','departmentRelasi']); 

    // kalau ada pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });

        // cari berdasarkan nama plant
            $query->orWhereHas('plantRelasi', function ($q) use ($search) {
                $q->where('plant', 'like', "%{$search}%");
            });

        // cari berdasarkan nama departemen
            $query->orWhereHas('departmentRelasi', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

    // paginate
        $users = $query->orderBy('name')->paginate(10);

    // supaya query search tetap di pagination
        $users->appends($request->all());

    // kirim ke view
        return view('user.index', compact('users'));
    }

    public function create()
    {
    // Ambil data plant dan departemen dari tabel masing-masing
        $plants = Plant::select('id', 'plant')->get();
        $departments = Departemen::select('id', 'nama')->get();

        return view('user.create', compact('plants', 'departments'));
    }

    // simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'email' => 'nullable|email|unique:users,email',
            'plant' => 'nullable|string',
            'department' => 'nullable|string',
            'type_user' => 'required|integer',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'plant' => $request->plant,
            'department' => $request->department,
            'type_user' => $request->type_user,
            'updater' => auth()->user()->name,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil dibuat');
    }

    public function edit(User $user)
    {
        $plants = Plant::all();
        $departments = Departemen::all();
        return view('user.edit', compact('user','plants','departments'));
    }
    // update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->uuid . ',uuid',
            'password' => 'nullable|string|min:6',
            'email' => 'nullable|email|unique:users,email,' . $user->uuid . ',uuid',
            'plant' => 'nullable|string',
            'department' => 'nullable|string',
            'type_user' => 'required|integer',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'email' => $request->email,
            'plant' => $request->plant,
            'department' => $request->department,
            'type_user' => $request->type_user,
            'updater' => auth()->user()->name,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    // hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    private function _mapRole($roleName)
    {
        $mapping = [
            'Admin' => 0,
            'Manager' => 1,
            'Supervisor' => 2,
            'Produksi' => 3,
            'Forelady' => 8,
            'QC Inspector' => 4,
        ];

        return $mapping[$roleName] ?? null;
    }

    public function syncUser(Request $request)
    {
        $data = $request->json()->all();

        if (empty($data['user'])) {
            return response()->json(['status'=>'error','message'=>'User missing'], 400);
        }

        $user = $data['user'];

        if (empty($user['username']) 
            || empty($user['department']['name']) 
            || empty($user['department']['plant'])
        ) {
            return response()->json(['status'=>'error','message'=>'Missing required fields'], 400);
    }

    DB::beginTransaction();
    try {
        // Ambil departemen & plant berdasarkan nama
        $departemen = Departemen::firstOrCreate(
            ['nama' => $user['department']['name']],
            ['uuid' => $user['department']['uuid'] ?? Str::uuid()]
        );

        $plant = Plant::firstOrCreate(
            ['plant' => $user['department']['plant']],
            ['uuid' => $user['department']['uuid'] ?? Str::uuid()]
        );

        // Cek user existing
        $existingUser = User::where('username', $user['username'])->first();

        $userData = [
            'uuid' => $user['uuid'] ?? Str::uuid(),
            'name' => $user['name'] ?? '',
            'username' => $user['username'],
            'email' => $user['email'] ?? null,
            'department' => $departemen->uuid,
            'plant' => $plant->uuid,
            'type_user' => $this->_mapRole($user['project_role']['role'] ?? null) ?? 0,
            'activation' => $user['activation'] ?? 0,
        ];

        if (!empty($user['password'])) {
            $userData['password'] = Hash::make($user['password']);
        }

        if ($existingUser) {
            $existingUser->update($userData);
        } else {
            User::create($userData);
        }

        DB::commit();
        return response()->json(['status'=>'success','message'=>'User synced successfully']);
    } catch (Throwable $e) {
        DB::rollBack();
        \Log::error('SyncUser Error', ['exception' => $e->getMessage(), 'user'=>$user]);
        return response()->json(['status'=>'error','message'=>$e->getMessage()], 500);
    }
}

public function syncPlant(Request $request)
{
    $data = $request->json()->all();

    if (empty($data['plant'])) {
        return response()->json(['status'=>'error','message'=>'Invalid payload: plant missing'], 400);
    }

    $plantData = $data['plant'];

    DB::beginTransaction();
    try {
        $plant = Plant::updateOrCreate(
            ['uuid' => $plantData['uuid'] ?? Str::uuid()],
            ['plant' => $plantData['plant']]
        );

        if (!empty($plantData['departments']) && is_array($plantData['departments'])) {
            foreach ($plantData['departments'] as $deptData) {
                Departemen::updateOrCreate(
                    ['uuid' => $deptData['uuid'] ?? Str::uuid()],
                    ['nama' => $deptData['department']]
                );
            }
        }

        DB::commit();
        return response()->json(['status'=>'success','message'=>'Plant & Departemen synced successfully']);
    } catch (Throwable $e) {
        DB::rollBack();
        \Log::error('SyncPlant Error', ['exception' => $e->getMessage()]);
        return response()->json(['status'=>'error','message'=>$e->getMessage()], 500);
    }
}
    /**
     * Desync user dari UUID
     */
    public function desyncUser(Request $request)
    {
        try {
            $data = $request->json()->all();

            if (empty($data['user_uuid'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload'
                ], 400);
            }

            $user = User::where('uuid', $data['user_uuid'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User desynced successfully: ' . $data['user_uuid']
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Aktivasi user
     */
    public function activation(Request $request)
    {
        try {
            $data = $request->json()->all();

            if (empty($data['user']['uuid'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload: uuid missing'
                ], 400);
            }

            $user = User::where('uuid', $data['user']['uuid'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            $user->activation = 1;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User Activation Success'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change password user
     */
    public function changePassword(Request $request)
    {
        try {
            $data = $request->json()->all();

            if (empty($data['user']['uuid']) || empty($data['user']['password'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid payload: uuid or password missing'
                ], 400);
            }

            $user = User::where('uuid', $data['user']['uuid'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            $user->password = Hash::make($data['user']['password']);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

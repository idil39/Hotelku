@extends('layouts.admin')

@section('title','Users')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    Data Users
                </h4>

                <a href="{{ route('admin.users.create') }}"
                    class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>

                    Tambah User

                </a>

            </div>

        </div>

        <div class="card-body">

            <form method="GET"
                class="row mb-3">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama atau email..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        Cari

                    </button>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="60">No</th>

                            <th>Nama</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>No HP</th>

                            <th>Alamat</th>

                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $user->name }}

                            </td>

                            <td>

                                {{ $user->email }}

                            </td>

                            <td>

                                @if($user->role == 'admin')

                                    <span class="badge bg-danger">

                                        Admin

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        Customer

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $user->phone }}

                            </td>

                            <td>

                                {{ $user->address }}

                            </td>

                            <td>

                                <a href="{{ route('admin.users.edit',$user) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                @if(auth()->id() != $user->id)

                                <form
                                    action="{{ route('admin.users.destroy',$user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus user ini?')"
                                        class="btn btn-danger btn-sm">

                                        Hapus

                                    </button>

                                </form>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="text-center">

                                Tidak ada data user.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
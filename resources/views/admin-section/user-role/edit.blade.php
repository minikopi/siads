@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update User Role
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <form method="POST" action="{{ route('administrator.user-role.update', $user) }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf @method('PUT')

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="name">User Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        type="input" name="name" id="name" autocomplete="off"
                                                        value="{{ old('name', $user->name) }}" readonly>
                                                    @error('name')
                                                        <div class="invalid-feedback" style="color: red;">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label" for="display_name">Role</label>
                                                <div class="col-md-9">
                                                    @foreach ($roles as $role)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}"
                                                                    @if ($user->hasRole($role->name))
                                                                        checked
                                                                    @endif>
                                                                {{ $role->display_name ?? $role->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-4 row justify-content-end">
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Set User Role</button>
                                                    <a href="{{ route('administrator.user-role.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
@endsection

@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
          <div class="title" style="display: flex; justify-content:space-between">
            <h4>Edit Profile</h4>
            <form action="/user-settings" method="get">
              @include('mypartials.tahunajaran')
              <button class="btn btn-sm btn-danger font-weight-bold" style="min-width: 5vw"> Back</button>
          </form>
          </div>
            <form class="pt-3" action="/simpan" method="post" style=" width: 100%;" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="avatar" class="form-label">Avatar</label>
                  <input class="form-control form-control-lg" type="file" id="formFile" name="profil" style="border-radius: 5px; height: 3vh;">
                </div>
                <div class="form-group">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control form-control-lg" placeholder="Masukan username"
                    name="name" style="border-radius: 5px;" value="{{ Auth::user()->name }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control input-email" id="email" placeholder="name@example.com" name="key" style="width: 100%; height: 7vh;" value="{{ Auth::user()->email }}" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-lg text-white auth-form-btn p-1" style="background-color: #3bae9c; font-size: 20px">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
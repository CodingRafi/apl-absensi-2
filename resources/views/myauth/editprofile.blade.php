@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <form class="pt-3" action="" method="post" style=" width: 100%;">
                @csrf
                <div class="form-group">
                  <label for="avatar" class="form-label">Avatar</label>
                  <input class="form-control form-control-lg" type="file" id="formFile" name="file" style="border-radius: 5px;">
                </div>
                <div class="form-group">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control form-control-lg" placeholder="username Sekolah"
                    name="username" style="border-radius: 5px;">
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control form-control-lg" placeholder="email"
                    name="email" style="border-radius: 5px;">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-lg text-white font-weight-bold auth-form-btn" style="background-color: #3bae9c">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
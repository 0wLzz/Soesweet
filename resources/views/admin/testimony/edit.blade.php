@extends('admin.admin')

@section('content')

        <h1 class="mt-4 mb-4" style="margin-top: 200px; margin-left: 100px">Edit Testimony</h1>
        <div class="card mb-4" style="margin: 0px 150px 100px 150px;">
            <form  action="{{ route('update_testimony', $testimony) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="card-header d-flex justify-content-end">
                    <Button class="btn btn-primary" type="submit">Simpan</Button>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <img id="previewImage" src="{{ $testimony->image ? asset('img/' . $testimony->image) : 'https://placehold.co/300/orange/white?text=Toy' }}" style="max-height: 400px; max-height: 400px;">
                    </div>

                    <div class="mb-4">
                        <h4>Gambar</h4>
                        <input id="imageInput" class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}" type="file" name="image">
                        @error('image')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <h4 for="" class="form-h4">Nama</h4>
                        <input type="text" class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}" name="name" value="{{ $testimony->name }} ">
                        @error('name')
                            <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <h4 for="" class="form-h4">Perushaan</h4>

                        <input type="text" class="form-control {{ $errors->has('company') ? ' border-danger' : '' }}" name="company" value="{{ $testimony->company }} ">
                        @error('company')
                            <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <h4>Deskripsi</h4>

                        <textarea id="description" name="description" style="width: 100%; padding: 10px">{{$testimony->description}} </textarea>
                        @error('description')
                            <span class="text-danger"> {{$message}} </span>
                        @enderror
                    </div>

                </div>
            </form>
        </div>
@endsection

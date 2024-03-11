@extends('layouts.app')

@section('title', 'Akun Profile')

@push('style')
    {{-- sweetalert2 --}}
    <link rel="stylesheet" href="{{ asset('extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profil</h3>
                <p class="text-subtitle text-muted">Halaman untuk mengubah data informasi akun</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="row">
        <div class="col-12" id="alertError">
            {{-- generate --}}
        </div>  
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button class="btn btn-ghost btn-edit-photo" data-id="{{ $user->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl">
                            <img src="{{asset("images/photo/".$user->photo)}}" alt="Avatar" id="avatarProfile">
                        </div>
                        <h3 class="mt-3" id="profileName">{{ $user->name }}</h3>
                        <p class="text-small">{{ $user->getRoleNames()->implode(', ') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="col-12" id="alertErrorProfile">
                        {{-- generate --}}
                    </div>    
                    <form method="post" id="changeProfile" class="needs-validation-updateProfile" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong dan harus sesuai format email
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button 
                        class="btn btn-ghost btn-edit-signature"
                        data-bs-toggle="modal"
                        data-bs-target="#modalSignature"
                    >
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl">
                            <img src="{{asset("images/signature/".$user->signature)}}" alt="Avatar" id="userAvatarSignature">
                        </div>
                        <p class="text-small">Tanda tangan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <div class="col-12" id="alertErrorPassword">
                        {{-- generate --}}
                    </div>    
                    <form method="post" id="chagePassword" class="needs-validation-updatePassword" novalidate>
                        @csrf
                        <div class="form-group my-2">
                            <label for="current_password" class="form-label">Password sekarang</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control" placeholder="Masukan password sekarang" required>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password baru" minlength="8" required>
                            <div class="invalid-feedback">
                                Password tidak boleh kosong dan minimal 8 karakter
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <label for="password_confirmation" class="form-label">Konfirmasi password<span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="konfirmasi Password" minlength="8" required>
                            <div class="invalid-feedback">
                                Konfirmasi password tidak boleh kosong dan harus sama
                            </div>
                        </div>

                        <div class="form-group my-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Modal Photo -->
        <div class="modal fade text-left" id="modalPhoto" tabindex="-1" role="dialog" aria-labelledby="modalPhotoHeader" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalPhotoHeader">Ubah photo profil</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/photo/'.$user->photo) }}" class="img-responsive photoProfile" width="300px" height="300px">
                        </div>
                        <form method="post" id="formUploadFoto" class="needs-validation-updatePhoto" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group" class="form-label" id="fileUploadDiv">
                                <label for="photo">Photo<span class="text-danger">*</span></label>
                                <input type="file" class="photo form-select" name="photo" id="fileUploadFoto" data-max-file-size="1MB" required>
                                <div class="invalid-feedback">
                                    Tidak boleh kosong
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm btn-close-form-photo" data-bs-dismiss="modal">
                            <span class="d-sm-block">Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1 btn-sm">
                            <span class="d-sm-block text-sm">Simpan</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal Signature -->
        <div class="modal fade text-left" id="modalSignature" tabindex="-1" role="dialog" aria-labelledby="modalSignatureHeader" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalSignatureHeader">Ubah tanda tangan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/signature/'.$user->signature) }}" class="img-responsive imageSignature" width="300px" height="300px">
                        </div>
                        <form method="post" id="formUploadSignature" class="needs-validation-updateSignature" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="signature">Tanda tangan baru<span class="text-danger">*</span></label>
                                <input type="file" class="signature form-select" name="signature" id="fileUploadSignature" data-max-file-size="1MB" required>
                                <div class="invalid-feedback">
                                    Tidak boleh kosong
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm btn-close-form-signature" data-bs-dismiss="modal">
                            <span class="d-sm-block">Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1 btn-sm">
                            <span class="d-sm-block text-sm">Simpan</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('script')
    {{-- Library Jquery --}}
    <script src="{{ asset('extensions/jquery/jquery.min.js') }}"></script>
    {{-- Sweetalert2 --}}
    <script src="{{ asset('extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    
    <script>
        
        // JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'
            $('#alert').hide();
            
            /*
                Handle Update photo profile
            */
            $('#fileUploadFoto').change(function(){            
                const file = this.files[0]; // gett All data file upload
                if (file){
                    // validasi size image
                    let size = file.size;
                    let maxSizeInMb = 1;
                    let sizeInMb = size / (1024 * 1024);
                    let validFileSize = true;
                    
                    if(sizeInMb > maxSizeInMb){
                        $('#fileUploadDiv .invalid-feedback').text('Ukuran file terlalu besar. Maksimum 1MB.'); 
                        validFileSize = false;
                    }
                    
                    // validasi file extension
                    const fileName = file.name;
                    const validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                    const extension = fileName.split('.').pop().toLowerCase();
                    let validFileExtension = true;

                    if (!validExtensions.includes(extension)) {
                        $('#fileUploadDiv .invalid-feedback').text('Format file tidak didukung.'); 
                        validFileExtension = false;
                    }

                    // ganti photo yang di pilih
                    let reader = new FileReader();
                    reader.onload = function(event){
                        // console.log(event.target.result);
                        $('.photoProfile').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);

                    // set cusmtom validasi
                    this.setCustomValidity((validFileSize && validFileExtension) ? '' : 'Error format tidak sesuai');
                }
            });

            // Validation updateFoto
            const formsPhoto = document.querySelectorAll('.needs-validation-updatePhoto')

            // Loop over them and prevent submission
            Array.from(formsPhoto).forEach(form => {
                form.addEventListener('submit', event => {              

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault()
                        event.stopPropagation()
                        uploadFoto(form);
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            function resetFormFoto(){
                $('#formUploadFoto').removeClass('was-validated')
                $('#formUploadFoto')[0].reset()
                $('.photoProfile').attr('src', "{{ asset('images/photo/'.$user->photo) }}");
            }

            function uploadFoto(form){
                let url = "{{ route('admin.user.updatePhoto') }}";
                let formData = new FormData(form);

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res){
                        resetFormFoto();
                        $('#modalPhoto').modal('hide');
                        $('#avatarProfile').attr('src', res.photo);
                        $('.photoProfile').attr('src', res.photo);
                        
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    },
                    error: function(error){
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
                            handleValidationErrorFromServer(errors, 'alertError')
                        } else {
                            alert('Ubah photo profil gagal, cobalah beberapa saat lagi');
                        }
                    }
                });
            }

            $('.btn-edit-photo').on('click', function(){
                const id = $(this).data('id');
                $('#modalPhoto').modal('show');
            });

            $('.btn-close-form-photo').on('click', function(){
                resetFormFoto();
            })


            /*
                Handle Update signature
            */

            $('#fileUploadSignature').change(function(){            
                const fileSingature = this.files[0]; // gett All data file upload
                if (fileSingature){
                    // validasi size image
                    let size = fileSingature.size;
                    let maxSizeInMb = 1;
                    let sizeInMb = size / (1024 * 1024);
                    let validFileSize = true;
                    
                    if(sizeInMb > maxSizeInMb){
                        $('#fileUploadSignature .invalid-feedback').text('Ukuran file terlalu besar. Maksimum 1MB.'); 
                        validFileSize = false;
                    }
                    
                    // validasi file extension
                    const fileName = fileSingature.name;
                    const validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                    const extension = fileName.split('.').pop().toLowerCase();
                    let validFileExtension = true;

                    if (!validExtensions.includes(extension)) {
                        $('#fileUploadSignature .invalid-feedback').text('Format file tidak didukung.'); 
                        validFileExtension = false;
                    }

                    // ganti photo yang di pilih
                    let reader = new FileReader();
                    reader.onload = function(event){
                        // console.log(event.target.result);
                        $('.imageSignature').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(fileSingature);

                    // set cusmtom validasi
                    this.setCustomValidity((validFileSize && validFileExtension) ? '' : 'Error format tidak sesuai');
                }
            });

            // Validation Signature
            const formSignature = document.querySelectorAll('.needs-validation-updateSignature')

            // Loop over them and prevent submission
            Array.from(formSignature).forEach(form => {
                form.addEventListener('submit', event => {            

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault()
                        event.stopPropagation()
                        uploadSignature(form);
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            function resetFormSignature(){
                $('#formUploadSignature').removeClass('was-validated')
                $('#formUploadSignature')[0].reset()
                $('.imageSignature').attr('src', "{{ asset('images/signature/'.$user->signature) }}");
            }

            function uploadSignature(form){
                let url = "{{ route('admin.user.updateSignature') }}";
                let formData = new FormData(form);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                        
                        $('#formUploadSignature')[0].reset();
                        $('#formUploadSignature').removeClass('was-validated');
                        
                        $('#userAvatarSignature').attr('src', res.signature)

                        $('#modalSignature').modal('hide');
                    },
                    error: function(error){
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;                                
                            handleValidationErrorFromServer(errors, 'alertError')
                        } else {
                            alert('Ubah tanda tangan gagal, cobalah beberapa saat lagi');
                        }
                    }
                });
            }

            $('.btn-edit-signature').on('click', function(){
                const id = $(this).data('id');
                $('#modalSignature').modal('show');
            });

            $('.btn-close-form-signature').on('click', function(){
                resetFormSignature();
            })


            // ---------------------------------- end

            const formsProfile = document.querySelectorAll('.needs-validation-updateProfile');
            // Loop over them and prevent submission
            Array.from(formsProfile).forEach(form => {
                form.addEventListener('submit', event => {
                    let fileSizeInMb = 0;
                    const fileMaxSizeInMb = 1;                

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault()
                        event.stopPropagation()
                        updateProfile(form);
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            function updateProfile(form){
                let url = "{{ route('admin.user.updateProfile') }}";
                let formData = new FormData(form);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })

                        $('#profileName').text(res.name);
                        $('#changeProfile').removeClass('was-validated');
                    },
                    error: function(error){
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;                                
                            handleValidationErrorFromServer(errors, 'alertErrorProfile')
                        } else {
                            alert('Ubah profil gagal, cobalah beberapa saat lagi');
                        }
                    }
                });
            }

            /*
                Handle Update password
            */
            const formsPassword = document.querySelectorAll('.needs-validation-updatePassword');
            // Loop over them and prevent submission
            Array.from(formsPassword).forEach(form => {
                form.addEventListener('submit', event => {
                    let fileSizeInMb = 0;
                    const fileMaxSizeInMb = 1;                

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault()
                        event.stopPropagation()
                        updatePassword(form);
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            function updatePassword(form){
                let url = "{{ route('admin.user.updatePassword') }}";
                let formData = new FormData(form);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res){
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                        
                        $('#chagePassword')[0].reset();
                        $('#chagePassword').removeClass('was-validated');
                    },
                    error: function(error){
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;                                
                            handleValidationErrorFromServer(errors, 'alertErrorPassword')
                        } else {
                            alert('Ubah password gagal, cobalah beberapa saat lagi');
                        }
                    }
                });
            }


            function handleValidationErrorFromServer(errors, container){
                let alertContainer= $('#'+container);
                let alertMessage = "";

                // jika error dari server
                $.each(errors, function(key, errorArray) {
                    $.each(errorArray, function(index, errorMessage) {
                        alertMessage += `<li class="error">${errorMessage}</li>`;
                    });
                });
                
                let alert = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
                    <div id="alertMessage">
                        ${alertMessage}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `

                alertContainer.html(alert);
            }


        })()
    </script>
@endpush
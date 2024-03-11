@extends('layouts.app')

@section('title', 'Akun')

@push('style')
    {{-- Data Table --}}
    <link rel="stylesheet" href="{{ asset('extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/table-datatable-jquery.css') }}">

    {{-- File Uploader --}}
    <link rel="stylesheet" href="{{ asset('extensions/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">

    {{-- sweetalert2 --}}
    <link rel="stylesheet" href="{{ asset('extensions/sweetalert2/sweetalert2.min.css') }}">

@endpush

@section('main')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Akun</h3>
                    <p class="text-subtitle text-muted">Halaman untuk manajemen akun</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Form buat akun</h6>
                        </div>
                        <div class="card-body">
                            <form id="buatAkun" action="{{ route('admin.user.create') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="alert alert-warning alert-dismissible fade" role="alert" id="alert">
                                    <div id="alertMessage"></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
    
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="{{ Cookie::get('name') !== null ? Cookie::get('name') : old('name') }}" required>
                                    <div class="invalid-feedback">
                                        Nama tidak boleh kosong
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ Cookie::get('email') !== null ? Cookie::get('email') : old('email') }}" required>
                                    <div class="invalid-feedback">
                                        Email tidak boleh kosong dan gunakan format email yang benar
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Your password" minlength="8" required>
                                    <div class="invalid-feedback">
                                        Password tidak boleh kosong dan minimal 8 karakter
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi password<span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="konfirmasi Password" minlength="8" required>
                                    <div class="invalid-feedback">
                                        Konfirmasi password tidak boleh kosong dan harus sama
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                                    <select name="role" id="role" class="form-select" required>
                                            <option value="">- Pilih Role -</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih Salah satu
                                    </div>
                                </div>

                                <div class="form-group" class="form-label">
                                    <label for="photo">Photo<span class="text-danger">*</span></label>
                                    <input type="file" class="photo form-select" name="photo" data-max-file-size="1MB" required>
                                    <div class="invalid-feedback">
                                        Tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group" class="form-label">
                                    <label for="signature">Tanda tangan<span class="text-danger">*</span></label>
                                    <input type="file" class="signature form-select" name="signature" data-max-file-size="1MB" required>
                                    <div class="invalid-feedback">
                                        Tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="btnSubmitForm">
                                        <span class="spinner-border spinner-border-sm" id="loader" aria-hidden="true" hidden></span>
                                        <span role="status" id="statusButton">Buat Akun</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6>Table Akun</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    {{-- Library Jquery --}}
    <script src="{{ asset('extensions/jquery/jquery.min.js') }}"></script>

    {{-- Library Data Table --}}
    <script src="{{ asset('extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('static/js/pages/datatables.js') }}"></script>

    <!-- Yajra DataTables -->
    {{ $dataTable->scripts() }}

    {{-- sweetalert2 --}}
    <script src="{{ asset('extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const Swal2 = Swal.mixin({
            customClass: {
                input: 'form-control'
            }
        })

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

    {{-- File Uploader --}}
    <script src="{{ asset('extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('extensions/filepond/filepond.js') }}"></script>
    

    {{-- File Uploader --}}
    <script>
        // Filepond: Image Preview
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
        )

        FilePond.create(document.querySelector(".photo"), {
            credits: null,
            allowImagePreview: true,
            allowImageFilter: false,
            allowImageCrop: false,
            required: true,
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                // Do custom type detection here and return with promise
                resolve(type)
                }),
            storeAsFile: true,
        })

        FilePond.create(document.querySelector(".signature"), {
            credits: null,
            allowImagePreview: true,
            allowImageFilter: false,
            allowImageCrop: false,
            required: true,
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                // Do custom type detection here and return with promise
                resolve(type)
                }),
            storeAsFile: true,
        })
    </script>

    {{-- Handle buat akun --}}
    <script>
        $(document).ready(function(){
            'use strict' // untuk validasi javascript yang lebih sensitif
            $('#alert').hide();
            // mencegah form untuk reload waktu di submit
            $('#buatAkun').submit(function(e){
                e.preventDefault();
            });

            function onLoading() {
                // Menambahkan properti disabled pada tombol submit
                $('#btnSubmitForm').prop('disabled', true);
                // Menghapus properti hidden pada spinner
                $('#loader').removeAttr('hidden');
                // Mengubah teks di statusButton menjadi "Loading..."
                $('#statusButton').text('Loading...');
            }

            function onSuccess(){
                // Kembalikan properti disabled pada tombol submit
                $('#btnSubmitForm').removeAttr('disabled');
                // Tambahkan kembali properti hidden pada spinner
                $('#loader').attr('hidden', true);
                // Kembalikan teks di statusButton menjadi "Buat Akun"
                $('#statusButton').text('Buat Akun');
            }

            function onErrorHandling() {
                // Lakukan tindakan atau tampilkan pesan kesalahan sesuai kebutuhan
                // Atau lakukan tindakan lain untuk menangani kesalahan
                alert("Maaf, terjadi kesalahan. Silakan coba lagi.");
            }

            function sendData(form){
                let url = "{{ route('admin.user.create') }}";
                    let formData = new FormData(form);

                    $.ajax({
                        url: url,
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: formData,
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function(){
                            onLoading();
                        },
                        success: function(res){
                            onSuccess(); // reset button
                            // reset form
                            $('#users-table').DataTable().ajax.reload();
                            $('#buatAkun')[0].reset();

                            // reset photo
                            let filePondPhoto = FilePond.find(document.querySelector(".photo"));
                            if (filePondPhoto != null) {
                                //this will remove all files
                                filePondPhoto.removeFiles();
                            }

                            // reset ttd
                            let filePondSignature = FilePond.find(document.querySelector(".signature"));
                            if (filePondSignature != null) {
                                //this will remove all files
                                filePondSignature.removeFiles();
                            }

                            // reset class form
                            $('form').removeClass('was-validated');

                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                        },
                        error: function(error) {
                            if (error.status === 422) {
                                onSuccess(); // reset button
                                let errors = error.responseJSON.errors;                                

                                $('#alert').show();
                                $('#alert').addClass('show');
                                let alertMessage = $('#alertMessage');
                                alertMessage.empty();
                                
                                // jika error dari server
                                $.each(errors, function(key, errorArray) {
                                    $.each(errorArray, function(index, errorMessage) {
                                        let li = $('<li>').addClass('error').text(errorMessage);
                                        alertMessage.append(li); // Menambahkan pesan kesalahan ke dalam kontainer
                                    });
                                });
                            } else {
                                // Fungsi untuk menangani kesalahan
                                onErrorHandling();
                                onSuccess(); // reset button
                            }
                        }
                    });
            }

            function handleFormSubmission() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            console.log('oke');
                            sendData(form)
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            }
            handleFormSubmission();
        });
    </script>

    {{-- Handle  reset password --}}
    <script>
        $(document).on('click', '#btn-resetPassword', function () {
            let id = $(this).data('id');

            let url = "{{ route('admin.user.resetPassword', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: "Reset password akun user ini?",
                html: 'Password akun user terkait akan kembali ke default menjadi <span class="fw-bold text-primary">digiQrifyForBetter</span>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#435ebe',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        success: function(data) {
                            $('#users-table').DataTable().ajax.reload();
                            Swal.fire(
                                'Berhasil!',
                                result.message,
                                'success'
                            )
                        }
                    });
                }
            })
        });
    </script>

    {{-- Handle  nonaktifkan akun --}}
    <script>
        $(document).on('click', '#btn-nonaktif', function () {
            let id = $(this).data('id');

            let url = "{{ route('admin.user.nonaktif', ['id' => ':id']) }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: "Nonaktifkan akun ini ?",
                html: 'Akun ini akan di nontaktifkann dan tidak dapat masuk ke sistem !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#435ebe',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        success: function(data) {
                            $('#users-table').DataTable().ajax.reload();
                            Swal.fire(
                                'Berhasil!',
                                result.message,
                                'success'
                            )
                        }
                    });
                }
            })
        });
    </script>

@endpush
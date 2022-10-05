<!doctype html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Hello, world!</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Pemberkasan Data Siswa</h1>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="" id="formBerkas" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <select class="js-example-basic-single form-control @error('user_id') is-invalid @enderror"
                    aria-label="Default select example" name="user_id" id="user_id" required>
                    <option value="" selected>Nama Siswa</option>
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id_user }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Kartu Keluarga</label>
                <input class="form-control @error('fileKK') is-invalid @enderror" type="file" id="formFile"
                    name="fileKK" accept="image/png, image/gif, image/jpeg, application/pdf">
                @error('fileKK')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="kkOld" id="kkOld">
            <div class="mb-3">
                <label for="formFile" class="form-label">Akta Lahir</label>
                <input class="form-control @error('fileAkta') is-invalid @enderror" type="file" id="formFile"
                    name="fileAkta" accept="image/png, image/gif, image/jpeg, application/pdf">
                @error('fileAkta')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="aktaOld" id="aktaOld">
            <div class="mb-3">
                <label for="formFile" class="form-label">Ijazah</label>
                <input class="form-control @error('fileIjazah') is-invalid @enderror" type="file" id="formFile"
                    name="fileIjazah" accept="image/png, image/gif, image/jpeg, application/pdf">
                @error('fileIjazah')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="ijazahOld" id="ijazahOld">
            <button class="btn btn-primary" type="submit" id="simpan">Simpan</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#formBerkas').submit(function(e) {
            e.preventDefault();
            var user_id = $('select[name=user_id] option').filter(':selected').val()
            var formData = new FormData(this);
            var btn = $('#simpan')
            $.ajax({
                url: "{{ url('cek-berkas') }}/" + user_id,
                success: function(response) {
                    // alert($.isEmptyObject(response));
                    if ($.isEmptyObject(response) == true) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/save') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $("#formBerkas")[0].reset();
                                $('#user_id').val(null).trigger('change');
                                alert('Data berhasil diupload');
                            },
                            // error: function(data) {
                            //     console.log(data);
                            // }
                        })
                    } else {
                        if (confirm("Data atas nama " + response.nama + " dengan NISN " + response
                                .username + " sudah ada, yakin ingin menimpa dengan data baru?") ==
                            true) {
                            const id = response.user_id;
                            $.ajax({
                                type: "POST",
                                url: "{{ url('update') }}/" + response.id,
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    $("#formBerkas")[0].reset();
                                    $('#user_id').val(null).trigger('change');
                                    alert('Data berhasil diupdate');
                                    // alert(data);
                                },
                                // error: function(data) {
                                //     // console.log(data);
                                // }
                            })
                        }
                    }
                }
            })
        })
    </script>
</body>

</html>

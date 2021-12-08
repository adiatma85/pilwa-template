@extends('layouts.app')
@section('content')
<div class="container">
    <section class="py-5 mb-5 text-center bg-primary">
        <h1>Pemilihan Presiden Mahasiswa FK UB 2021</h1>
        <h3>Pilih salah satu kandidat dengan menekan tombol <b>Pilih</b></h3>
    </section>
    <section class="row">
        {{-- Template --}}
        {{-- <article class="col-md-6 text-center">
            <img class="w-100"
                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
            <h4 class="my-3"><b>Lorem Ipsum Dulur</b></h4>
            <a href="" class="btn btn-primary btn-lg">Pilih</a>
        </article> --}}

        {{-- Foreach --}}
        @foreach ($calonsBems as $calonBem)
        <article class="col-md-6 text-center">
            <img class="w-100" src="{{ $calonBem->image->getUrl() ?? "
                https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" }}" alt="">
            <h4 class="my-3"><b>{{ $calonBem->name ?? "Nama Calon" }}</b></h4>
            {{-- <form action="{{ route('user.kotak-suara.storeBem') }}" method="POST" class="each-form"> --}}
                {{-- @csrf --}}
                <button class="btn btn-primary btn-lg btn-choice" id="btn-choice" data-cln="{{ $calonBem->id }}" data-name="{{ $calonBem->name ?? "Nama Calon" }}">Pilih</button>
            {{-- </form> --}}
        </article>
        @endforeach
    </section>
</div>
@endsection

{{-- Custom scripts --}}
@section('scripts')
<script>
    function swalConfirmationFire(cln, name) {
            Swal.fire({
                title: `Apakah Anda memilih kandidat ${name}?`,
                text: "Anda tidak akan dapat mengubah pilihan ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Ajax Post

                    $.ajax({
                        url: "{{ route('user.kotak-suara.storeBem') }}",
                        type: 'post',
                        crossDomain: true,
                        data: {
                            calon_id: cln,
                            _token: "{{ csrf_token() }}"
                        },
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (response){
                            console.log(response)
                        }
                    });
                }
            })
        }

        // Get all the data item and fire a swal
        var functionHandler = function (event) {
            event.preventDefault();
            var dataCln = $(this).data("cln");
            var dataName = $(this).data("name");

            // Fire a swal
            swalConfirmationFire(dataCln, dataName, $(this));
        }

        // Button listener
        $(".btn-choice").on('click', functionHandler);
</script>
@endsection


{{-- // $.post('{{ route('user.kotak-suara.storeBem') }}', { calon_id: cln, _token : "{{ csrf_token() }}" })
                    //     .then( () => {
                    //         Swal.fire(
                    //             'Pilihan Anda tersimpan dalam sistem!',
                    //             '',
                    //             'success'
                    //         );
                    //     } )
                    //     ; --}}
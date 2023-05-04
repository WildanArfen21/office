@extends('template.main')
@section('konten')
@section('title' ,'Halaman Kategori')
@section('page','Data Kategori')

<div class="card">
    <div class="card-header">
        {{-- <a href="/kategori/create" class="btn btn-primary">Tambah Data</a> --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Create
        </button>
        <div id="success" class="text-center"></div>
    </div>
    <div class="card-body" id="read">


    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        @include('kategori.create')

    </div>

</div>


<script type="text/javascript">
    function showdata() {
        $.ajax({
            type: "get",
            url: "/show-kategori",
            dataType: "json",
            success: function (response) {
                // console.log(response.kategori);
            }
        });

    }

    function read() {
            $.get("{{ url('kategori/read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
    function create() {
            $.get("{{ url('kategori/create') }}", {}, function(data, status) {
                $("#modal-default").html(data);
            });
        }


    function store() {

        var data = {
            'nama': $('#nama').val(),
            'kode': $('#kode').val(),
        }

        // console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ url('kategori/store') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 400) {
                    $('#errorform').html("");
                    $('#errorform').addClass('alert alert-danger');
                    $('#errorform').text(response.err)
                } else {
                    $('#errorform').html("");
                    $('#success').addClass('alert alert-success')
                    $('#success').text(response.message)
                    $('#btn-close').click();

                    read();
                }
            }
        });
    }

    // $(document).ready(function(){
    //     $(document).on('click','#submitbtn', function(e){
    //         e.preventDefault();
    //         var data = {
    //             'kode' : $('.kode').val(),
    //             'nama' : $('.nama').val(),
    //         }
    //     })
    // })

</script>


@endsection

<!doctype html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Álbum</title>
    <style>
        .navbar { margin-bottom: 20px; }
        :root { --jumbotron-padding-y: 10px; }
        .img-height {
            height: 240px !important;
        }
        textarea {
            resize: none;
        }
        .jumbotron {
          padding-top: var(--jumbotron-padding-y);
          padding-bottom: var(--jumbotron-padding-y);
          margin-bottom: 0;
          background-color: #fff;
        }
        @media (min-width: 768px) {
          .jumbotron {
            padding-top: calc(var(--jumbotron-padding-y) * 2);
            padding-bottom: calc(var(--jumbotron-padding-y) * 2);
          }
        }
        .jumbotron p:last-child { margin-bottom: 0; }
        .jumbotron-heading { font-weight: 300; }
        .jumbotron .container { max-width: 40rem; }
        .btn-card { margin: 4px; }
        .btn { margin-right: 5px; }
        footer { padding-top: 3rem; padding-bottom: 3rem; }
        footer p { margin-bottom: .25rem; }
    </style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Your gallery</h1>
          <form method="POST" action="/gallery" enctype="multipart/form-data">
            @csrf
            <input class="form-control" id="id_user" name="id_user" hidden value="{{ Auth::user()->id }}">
            <div class="form-group text-left">
              <label for="subtitle">Subtitle</label>
              <input class="form-control" id="subtitle" name="subtitle" maxlength="30" required>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="file" name="file" required>
              <label class="custom-file-label" for="file">Choose a file</label>
            </div>
            <p>
              <button type="submit" class="btn btn-primary my-2">Send</button>
              <button type="reset" class="btn btn-secondary my-2">Cancel</button>
            </p>
          </form>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            @foreach ($gallery as $galleryItem)
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <img class="card-img-top figure-img img-fluid rounded img-height" src="/storage/{{$galleryItem->file}}" width="320">
                    <div class="card-body">
                        <p class="card-text">{{$galleryItem->subtitle}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <!--button type="button" class="btn btn-sm btn-outline-secondary">Download</button-->
                          <a type="button" class="btn btn-sm btn-outline-secondary" href="/gallery/download/{{$galleryItem->id}}">Download</a>
                          <form method="POST" action="/gallery/{{$galleryItem->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
          </div>
        </div>
      </div>
    </main>
    @endsection
    {{-- <script src="{{ asset('js/app.js') }}" type="text/javascript"></script> --}}
</body>
</html>

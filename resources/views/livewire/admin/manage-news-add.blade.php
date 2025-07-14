@vite([
'resources/css/jesselyn.css',
'resources/css/sorting.css',
])
<div class="container mt-5">
    <h2>News</h2>
    <form action="" method="POST">
        @csrf
        <div class="d-flex gap-5 flex-column">
          <div class="w-100 h-100">
            <label for="judul" class="form-label mb-5">Add your news here!</label>

            <trix-editor input="isi" style="border: 2px solid #333; border-radius: 4px; padding: 1rem; margin-top: 1rem;"></trix-editor>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>

@push('scripts')
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
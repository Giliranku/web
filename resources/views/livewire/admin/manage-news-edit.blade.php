<div class="container mt-5">
    <h2>News</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="d-flex gap-5 flex-column">
          <div class="w-100 h-100">
            <label for="judul" class="form-label mb-5">Edit your news here!</label>
            <trix-editor input="isi" style="border: 2px solid #333; border-radius: 4px; padding: 1rem; margin-top: 1rem;"></trix-editor>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
  tinymce.init({
    selector: '#editor',
    height: 500,
    menubar: true,
    plugins: [
      'advlist autolink lists link image charmap preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table code help wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image media table | ' +
             'removeformat | preview fullscreen code',
    branding: false,
    content_style: `
      body { font-family:Arial,sans-serif; font-size:14px }
    `
  });
</script>
@endpush
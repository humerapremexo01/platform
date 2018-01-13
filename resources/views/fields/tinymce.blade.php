<div class="form-group{{ $errors->has($oldName) ? ' has-error' : '' }}">

     @if(isset($title))
        <label for="{{$id}}">{{$title}}</label>
    @endif

    <div class="tinymce-{{$id}} b wrapper" style="min-height: 500px">
      {!! $value or old($name) !!}
    </div>

     <input type="hidden" @include('dashboard::partials.fields.attributes', ['attributes' => $attributes])>

    @if(isset($help))
        <p class="help-block">{{$help}}</p>
    @endif
</div>
@include('dashboard::partials.fields.hr', ['show' => $hr ?? true])

@push('scripts')
    <script>
$(function () {
    tinymce.init({
        selector: '.tinymce-{{$id}}',
        theme: 'inlite',
        min_height: 600,
        plugins: 'image media table link paste contextmenu textpattern autolink codesample',
        insert_toolbar: 'quickimage quicktable media codesample fullscreen',
        selection_toolbar: 'bold italic | quicklink h2 h3 blockquote | alignleft aligncenter alignright alignjustify | outdent indent | removeformat ',
        inline: true,
        convert_urls: false,
        image_caption: true,
        image_title: true,
        image_class_list: [
            {title: 'None', value: ''},
            {title: 'Responsive', value: 'img-responsive'},
        ],

        setup: function (ed) {
            ed.on('change', function (e) {
                $('#{{$id}}').val(ed.getContent());
            });
        },
        // we override default upload handler to simulate successful upload
        images_upload_handler: function (blobInfo, success, failure) {

            let data = new FormData();
            data.append('file', blobInfo.blob());

            axios.post(dashboard.prefix('/systems/files'), data)
                .then(function (response) {
                    success('/storage/' + response.data.path + response.data.name + '.' + response.data.extension);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


    });
});
</script>
@endpush

















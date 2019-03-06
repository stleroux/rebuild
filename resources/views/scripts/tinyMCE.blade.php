<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=aye0kmmyja4hfhckelt1xd1srcm6j38ptyvy67g8rkfodfd8"></script>

<script>
   tinymce.init({
      selector: '.wysiwyg',
      height: 300,
      branding: false,
      theme: 'modern',
      plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern emoticons',
      // help-> displays help menu; fullpage->save whole html codes in page
      toolbar1: 'formatselect | undo redo | insert | styleselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | source',
      image_advtab: true,
      templates: [
         { title: 'Test template 1', content: 'Test 1' },
         { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
         'fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
         'www.tinymce.com/css/codepen.min.css'
      ]
   });
</script>

<script>
   tinymce.init({
      selector: '.simple',
      toolbar_items_size : 'small',
      branding: false,
      menubar: false,
      plugins: [
         'advlist autolink lists link charmap print preview anchor',
         'searchreplace visualblocks code fullscreen',
         'insertdatetime media table contextmenu paste code'
      ],
      toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
      content_css: '//www.tinymce.com/css/codepen.min.css'
   });
</script>
<script>
   tinymce.init({
      selector: '.plain',
      // content_style: "div {margin: 1px; border: 5px solid red; padding: 3px}",
      branding: false,
      menubar: false,
      toolbar: false,
      statusbar: false,
      // content_css: '//www.tinymce.com/css/codepen.min.css'
   });
</script>
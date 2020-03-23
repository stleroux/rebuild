<input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

<div class="form-row">
   @include('admin.articles.forms.fields.title')
   @include('admin.articles.forms.fields.category')
   @include('admin.articles.forms.fields.published_at')
</div>

<div class="form-row">
   @include('admin.articles.forms.fields.description_eng')
</div>

<div class="form-row">
   @include('admin.articles.forms.fields.description_fre')
</div>

<script>
   window.onload = function() {
      document.getElementById("title").focus();
   };
</script>
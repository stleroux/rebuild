<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.publishAll') }}"
   formmethod="POST"
   id="bulk-publish"
   title="Publish Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to publish these {{ $model }}s?')">
   <i class="fas fa-upload"></i>
      {{-- Publish Selected --}}
</button>
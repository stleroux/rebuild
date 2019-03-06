<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.restoreAll') }}"
   formmethod="POST"
   id="bulk-restore"
   title="Restore Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to restore all these {{ $model }}s?')">
   <i class="fas fa-trash-restore-alt"></i>
   @if($type == 'menu')
      Restore Selected
   @endif
</button>
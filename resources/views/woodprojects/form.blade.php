<div class="form-group">
   <label for="name" class="required">Name</label>
   <input type="text" name="name" value="{{ old('name') ?? $woodproject->name }}" class="form-control form-control-sm">
   <div class="text-danger">{{ $errors->first('name') }}</div>
</div>

<div class="form-group">
   <label for="email">Email</label>
   <input type="text" name="email" value="{{ old('email') ?? $woodproject->email }}" class="form-control form-control-sm">
   <div>{{ $errors->first('email') }}</div>
</div>

<div class="form-group">
   <label for="status">Status</label>
   <select name="status" id="status" class="form-control form-control-sm">
      @foreach($woodproject->statusOptions() as $statusOptionKey => $statusOptionValue)
         <option value="{{$statusOptionKey}}" {{ $woodproject->status == $statusOptionValue ? 'selected' : '' }}>{{ $statusOptionValue }}</option>
      @endforeach
   </select>
   <div>{{ $errors->first('status') }}</div>
</div>
   
@csrf

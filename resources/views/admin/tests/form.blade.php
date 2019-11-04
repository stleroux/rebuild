<div class="form-group">
   <label for="name">Name</label>
   <input type="text" name="name" value="{{ old('name') ?? $test->name }}" class="form-control form-control-sm">
   <div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
</div>

<div class="form-group">
   <label for="email">Email</label>
   <input type="text" name="email" value="{{ old('email') ?? $test->email }}" class="form-control form-control-sm">
   <div class="pl-1 bg-danger">{{ $errors->first('email') }}</div>
</div>

<div class="form-group">
   <label for="status">Status</label>
   <select name="status" id="status" class="form-control form-control-sm">
      @foreach($test->statusOptions() as $statusOptionKey => $statusOptionValue)
         <option value="{{$statusOptionKey}}" {{ $test->status == $statusOptionValue ? 'selected' : '' }}>{{ $statusOptionValue }}</option>
      @endforeach
   </select>
   <div class="pl-1 bg-danger">{{ $errors->first('status') }}</div>
</div>
   
@csrf

@php
$required = !empty($is_required) ? 'required ': '';
@endphp


@if($type == 'text' && !empty($field_name) && !empty($pname))
<div class="form-group">
   <label for="{{ $field_name }}">{{ $pname }}</label>
   <div class="controls">
      <input type="text" id="{{ $field_name }}" class="form-control" {{ $required }}
      {{ $is_disabled ?? '' }} placeholder="{{ $pname }}" name="{{ $field_name }}" value="{{ old('$field_name') ?? !empty($val) ? $val : '' }}">
      <span class="help-block">{{ $errors->first($field_name) }}</span>
   </div>
</div>

@elseif($type == 'tel' && !empty($field_name) && !empty($pname) && !empty($maxLen))
<div class="form-group">
   <label for="{{ $field_name }}">{{ $pname }}</label>
   <div class="controls">
      <input type="tel" id="{{ $field_name }}" class="form-control" {{ $required }} placeholder="{{ $pname }}" name="{{ $field_name }}" maxlength="{{ $maxLen }}"
      onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{ $val ?? old('$field_name') }}">
      <!-- <label for="{{ $field_name }}">{{ $pname }}</label> -->
      <span class="help-block">{{ $errors->first($field_name) }}</span>
   </div>
</div>

@elseif($type == 'email' && !empty($field_name) && !empty($pname))
<label for="{{ $field_name }}">{{ $pname }}</label>
<div class="form-label-group">
   <input type="email" id="{{ $field_name }}" class="form-control {{ $required }}" placeholder="{{ $pname }}" name="{{ $field_name }}" value="{{ $val ?? old('$field_name') }}">
   <!-- <label for="{{ $field_name }}">{{ $pname }}</label> -->
   <span class="help-block">{{ $errors->first($field_name) }}</span>
</div>

@elseif($type == 'datePicker' && !empty($field_name) && !empty($pname))
<label for="{{ $field_name }}">{{ $pname }}</label>
<div class="form-label-group">
   <fieldset class="form-group position-relative has-icon-left">
      <input type="text" id="{{ $field_name }}" class="form-control pickadate-months-year" {{ $required }} placeholder="{{ $pname }}" name="{{ $field_name }}" value="{{ $val ?? old('$field_name') }}">
      <div class="form-control-position">
         <i class='bx bx-calendar'></i>
      </div>
      <div class="controls">
         <span class="help-block">{{ $errors->first($field_name) }}</span>
      </div>
   </fieldset>
   <label for="{{ $field_name }}">{{ $pname }}</label>
</div>

@elseif($type == 'radio' && !empty($field_name) && !empty($pname) && !empty($id))
<li class="d-inline-block mr-2 mb-1">
   <fieldset>
      <div class="radio radio-shadow">
         <input type="radio" id="{{ $id }}" name="{{ $field_name }}" {{ $is_checked ?? '' }} value="{{ $val }}">
         <label for="{{ $id }}">{{ $pname }}</label>
      </div>
   </fieldset>
</li>

@elseif($type == 'button' && !empty($field_name) && !empty($pname) && !empty($class))
<button type="{{ $field_name }}" class="{{ $class }}">{{ $pname }}</button>

@elseif($type == 'select' && !empty($field_name) && !empty($pname) && !empty($options))
<label for="{{ $field_name }}">{{ $pname }}</label>
<fieldset class="form-group">
   <select class="form-control {{ isset($is_multiple) ? 'select2' : '' }}" {{ $required }} id="{{ $field_name }}" {{ $is_multiple ?? '' }} name="{{ $field_name }}{{ isset($is_multiple) ? '[]' : '' }}">
    @if(!isset($val) && !isset($is_multiple))
        <option selected disabled>Select {{ $pname }}</option>
    @endif

    @if(isset($val) && is_array($val))
        @foreach($options as $key => $value)
            <option value="{{ $key }}"   {{ in_array($key,$val) ? 'selected' : '' }} >{{ $value }}</option>
        @endforeach
    @else
        @foreach($options as $key => $value)
            <option value="{{ $key }}"   {{ isset ($val) && ($val == $key) ? 'selected' : '' }} >{{ $value }}</option>
        @endforeach
    @endif

   </select>
   <div class="controls">
      <span class="help-block">{{ $errors->first($field_name) }}</span>
   </div>
</fieldset>


@elseif($type == 'textarea' && !empty($field_name) && !empty($pname) && !empty($length) && !empty($rows))
<label for="{{ $field_name }}">{{ $pname }}</label>
<fieldset class="form-label-group mb-0 form-group">
   <textarea data-length="{{ $length }}" class="form-control char-textarea" {{ $required }} name="{{ $field_name }}" id="textarea-counter" rows="{{ $rows }}" placeholder="{{ $pname }}">{{ $val ?? old('$field_name') }}</textarea>
   <div class="controls">
      <span class="help-block">{{ $errors->first($field_name) }}</span>
   </div>
</fieldset>
<small class="counter-value float-right"><span class="char-count">0</span> / {{ $length }} </small>
@endif
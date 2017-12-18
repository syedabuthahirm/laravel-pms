{{ csrf_field() }}
<div class="field">
  <label class="label">
  Comment
  <span class="has-text-danger" title="Field required">*</span>
  </label>
  <div class="control">
    <textarea required class="textarea {{ ($errors->has('body')) ? 'is-danger' : '' }}" name="body">{{ old('body') ? old('body') : $newComment->body }}</textarea>
  </div>
    @if($errors->has('body'))
        <p class="help is-danger">{{ $errors->first('body') }}</p>
    @endif
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
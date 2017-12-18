{{ csrf_field() }}
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Title
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <input required class="input" type="text" name="title" value="{{ old('title') ? old('title') : $status->title }}">
            </div>
            @if($errors->has('title'))
            <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">Slug</label>
            <div class="control">
                <input class="input" type="text" name="slug" value="{{ old('slug') ? old('slug') : $status->slug }}">
            </div>
        </div>
    </div>
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
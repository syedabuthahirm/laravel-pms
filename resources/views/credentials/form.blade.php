{{ csrf_field() }}
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Title
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <input required class="input {{ ($errors->has('title')) ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') ? old('title') : $credential->title }}">
            </div>
            @if($errors->has('title'))
            <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Domain
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <input required class="input {{ ($errors->has('url')) ? 'is-danger' : '' }}" name="url" type="url" value="{{ old('url') ? old('url') : $credential->url }}">
            </div>
            @if($errors->has('url'))
            <p class="help is-danger">{{ $errors->first('url') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                User name
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <input required class="input {{ ($errors->has('username')) ? 'is-danger' : '' }}" name="username" type="text" value="{{ old('username') ? old('username') : $credential->username }}">
            </div>
            @if($errors->has('username'))
            <p class="help is-danger">{{ $errors->first('username') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Password
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <input required class="input {{ ($errors->has('password')) ? 'is-danger' : '' }}" name="password" type="text" value="{{ old('password') ? old('password') : $credential->password }}">
            </div>
            @if($errors->has('password'))
            <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="field">
    <label class="label">Extra Info</label>
    <div class="control">
        <textarea class="textarea" name="others">{{ old('others') ? old('others') : $credential->others }}</textarea>
    </div>
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
<a class="button is-info" href="{{ route('projects.credentials.index',$project->id) }}">Back</a>
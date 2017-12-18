{{ csrf_field() }}
<div class="field">
    <label class="label">
        Title
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <input required class="input" type="text" name="title" value="{{ old('title') ? old('title') : $task->title }}">
    </div>
    @if($errors->has('title'))
    <p class="help is-danger">{{ $errors->first('title') }}</p>
    @endif
</div>
<div class="field">
    <label class="label">
        Description
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <textarea required class="textarea {{ ($errors->has('description')) ? 'is-danger' : '' }}" name="description">{{ old('description') ? old('description') : $task->description }}</textarea>
    </div>
    @if($errors->has('description'))
    <p class="help is-danger">{{ $errors->first('description') }}</p>
    @endif
</div>
<div class="field">
    <label class="label">
        Status
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <div class="select is-fullwidth {{ ($errors->has('status_id')) ? 'is-danger' : '' }}">
            <select required name="status_id">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ ( $task->status_id === $status->id ) ? 'selected' : '' }}>{{ $status->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if($errors->has('status_id'))
    <p class="help is-danger">{{ $errors->get('status_id') }}</p>
    @endif
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
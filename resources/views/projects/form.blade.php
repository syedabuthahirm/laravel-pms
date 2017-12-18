{{ csrf_field() }}
<div class="field">
    <label class="label">
        Title
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <input required class="input {{ ($errors->has('title')) ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') ? old('title') : $project->title }}">
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
        <textarea required class="textarea {{ ($errors->has('description')) ? 'is-danger' : '' }}" name="description">{{ old('description') ? old('description') : $project->description }}</textarea>
    </div>
    @if($errors->has('description'))
    <p class="help is-danger">{{ $errors->first('description') }}</p>
    @endif
</div>
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Client
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('client_id')) ? 'is-danger' : '' }}">
                    <select required name="client_id">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ ( $project->client_id === $client->id ) ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($errors->has('client_id'))
                <p class="help is-danger">{{ $errors->get('client_id') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Status
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('status_id')) ? 'is-danger' : '' }}">
                    <select required name="status_id">
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ ( $project->status_id === $status->id ) ? 'selected' : '' }}>{{ $status->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($errors->has('status_id'))
                <p class="help is-danger">{{ $errors->get('status_id') }}</p>
            @endif
        </div>
    </div>
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
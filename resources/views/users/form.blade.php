{{ csrf_field() }}
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Name
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <p class="control">
                <input 
                class="input {{ ( $errors->has('name') ) ? 'is-danger' : '' }}"
                id="name"
                type="name"
                name="name"
                value="{{ old('name') ? old('name') : $user->name }}"
                required autofocus>
            </p>
            @if ($errors->has('name'))
            <p class="help is-danger">
                {{ $errors->first('name') }}
            </p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                E-mail Address
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <p class="control">
                <input
                class="input {{ ($errors->has('email')) ? 'is-danger' : '' }}"
                id="email"
                type="email"
                name="email"
                value="{{ old('email') ? old('email') : $user->email }}"
                required autofocus>
            </p>
            @if ($errors->has('email'))
            <p class="help is-danger">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>
    </div>
</div>
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Password
                @if( ! $user->exists )
                <span class="has-text-danger" title="Field required">*</span>
                @endif
            </label>
            <p class="control">
                <input
                class="input {{ ( $errors->has('password') ) ? 'is-danger' : '' }}"
                id="password"
                type="password"
                name="password">
            </p>
            @if ($errors->has('password'))
            <p class="help is-danger">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Confirm Password
                @if( ! $user->exists )
                    <span class="has-text-danger" title="Field required">*</span>
                @endif
            </label>
            <p class="control">
                <input class="input" id="password-confirm" type="password" name="password_confirmation">
            </p>
        </div>
    </div>
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">
<aside class="menu">
    <p class="menu-label">
        General
    </p>
    <ul class="menu-list">
        <li><a class="{{ isActive('dashboard') }}" href="{{ route('dashboard') }}">Dashboard</a></li>
        @role('admin')        
        <li>
            <a class="{{ isActive('users.index') }}" href="{{ route('users.index') }}">Clients</a>
        </li>
        @endrole
    </ul>
    <p class="menu-label">
        Project
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('projects.index') }}" href="{{ route('projects.index') }}">Projects</a>
        </li>
        <li>
            <a class="{{ isActive('projects.create') }}" href="{{ route('projects.create') }}">New Project</a>
        </li>
    </ul>
    @role('admin')
    <p class="menu-label">
        Status
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('statuses.index') }}" href="{{ route('statuses.index') }}">Statuses</a>
        </li>
        <li>
            <a class="{{ isActive('statuses.create') }}" href="{{ route('statuses.create') }}">New Status</a>
        </li>
    </ul>
    <p class="menu-label">
        User
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('users.create') }}" href="{{ route('users.create') }}">New Client</a>
        </li>
    </ul>
    @endrole
</aside>
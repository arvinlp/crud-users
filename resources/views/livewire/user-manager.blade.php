<div>
    <h2>{{ $isEdit ? 'Edit User' : 'Create User' }}</h2>

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'create' }}">
        <input type="text" wire:model.defer="first_name" placeholder="First Name">
        @error('first_name') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model.defer="last_name" placeholder="Last Name">
        @error('last_name') <span>{{ $message }}</span> @enderror

        <input type="text" wire:model.defer="mobile" placeholder="Mobile">
        @error('mobile') <span>{{ $message }}</span> @enderror

        <button type="submit">{{ $isEdit ? 'Update' : 'Create' }}</button>
        <button type="button" wire:click="resetForm">Cancel</button>
    </form>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <hr>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First</th>
                <th>Last</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr wire:key="user-{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->mobile }}</td>
                <td>
                    <button wire:click="edit({{ $user->id }})">Edit</button>
                    <button wire:click="delete({{ $user->id }})"
                            onclick="return confirm('Are you sure?')">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>

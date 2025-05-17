<div>
    <flux:callout class="mb-6">
        <h2>{{ $isEdit ? 'Edit User' : 'Create User' }}</h2>

        <form class="" wire:submit.prevent="{{ $isEdit ? 'update' : 'create' }}">
            <flux:field class="mb-3">
                <flux:input wire:model="nickname" :label="__('Nickname')" type="text" required autofocus
                    autocomplete="nickname" placeholder="Johnny" />
                <flux:error name="nickname" />
            </flux:field>
            <flux:field class="mb-3">
                <flux:input wire:model="first_name" :label="__('First Name')" type="text" required autofocus
                    autocomplete="given-name" placeholder="John" />
                <flux:error name="first_name" />
            </flux:field>
            <flux:field class="mb-3">
                <flux:input wire:model="last_name" :label="__('Last Name')" type="text" required autofocus
                    autocomplete="family-name" placeholder="Doe" />
                <flux:error name="last_name" />
            </flux:field>
            <flux:field class="mb-3">
                <flux:input wire:model="mobile" :label="__('Mobile number')" type="number" required autofocus
                    autocomplete="mobile" placeholder="0912345678" pattern="[0-9]{10}"
                    title="Please enter a valid mobile number" inputmode="numeric" maxlength="10" minlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false" />
                <flux:error name="mobile" />
            </flux:field>
            <flux:field class="mb-3">
                <flux:input wire:model="email" :label="__('Email address')" type="email" required autofocus
                    autocomplete="email" placeholder="email@example.com" />
                <flux:error name="email" />
            </flux:field>

            <flux:button.group class="mt-6">
                <flux:button type="submit">{{ $isEdit ? 'Update' : 'Create' }}</flux:button>
                <flux:button wire:click="resetForm" variant="ghost">Cancel</flux:button>
            </flux:button.group>
        </form>
    </flux:callout>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <hr>

    <table class="table-fixed">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!isset($users))
                <tr>
                    <td colspan="6" class="text-center">No users found</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <flux:button.group>
                                <flux:button wire:click="edit({{ $user->id }})">Edit</flux:button>
                                <flux:button wire:click="delete({{ $user->id }})"
                                    wire:confirm="Are you sure you want to delete this post?">Delete</flux:button>
                            </flux:button.group>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $users->links() }}
</div>

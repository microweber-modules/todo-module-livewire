<module type="admin/modules/info"/>

<div class="card style-1 mb-3">

    <div class="card-header">
        <module type="admin/modules/info_module_title" for-module="todo-module-livewire"/>
    </div>

    <div class="card-body pt-3">
        <div class="row">
            <div class="col-md-3">
                @livewire('todo-module-livewire.todo-notification-component') <!-- This component will show notification when todo is saved or updated -->
                @livewire('todo-module-livewire.form-component') <!-- This component will display Todo form -->
            </div>
            <div class="col-md-9">
                @livewire('todo-module-livewire.list-component') <!-- This component will list Todos -->
            </div>
        </div>
    </div>
</div>


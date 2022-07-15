<div class="list-container">
    <style>
        .table p {
            margin: 0;
        }

        .filter-container {
            margin-bottom: 15px;
            padding: 15px;
            padding-left: 20px;
            background: #f5f5f5;
            color: #242424;
            border-radius: 4px;
        }

        .filter-container > .row {
            margin: 0;
        }

        .filter-container > .row > div {
            padding: 0 5px;
        }
    </style>

    <div wire:loading wire:init="loadList">
        {{ $loadingMessage }}
    </div>

    <div class="filter-container">
        <div class="row">
            <div class="col-md-3">
                <label for="">Search Title</label>
                <input type="text" class="form-control" wire:model="filter.search">
            </div>

            <div class="col-md-2">
                <label for="">Status</label>
                <select wire:model="filter.status" class="form-control">
                    <option value="">Any</option>
                    <option value="pending">Task Pending</option>
                    <option value="accomplished">Task Accomplished</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="">Order Field</label>
                <select wire:model="filter.order_field" class="form-control">
                    <option value="">Any</option>
                    <option value="title">Task Title</option>
                    <option value="status">Task Status</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="">Order Type</label>
                <select wire:model="filter.order_type" class="form-control">
                    <option value="">Any</option>
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
            </div>

            <div class="col-md-2" style="display: flex;align-items: flex-end;">
                <div>
                    <button type="button" wire:click="loadList" class="btn btn-outline-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th style="width:50%;">Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @if(!empty($todos))
                @foreach($todos as $todo)
                    <tr>
                        <td>
                            <div>
                                <p><strong>Title:</strong> {{ $todo["title"] }}</p>
                                <p><strong>Description:</strong> {{ $todo["description"] }}</p>
                            </div>
                        </td>
                        <td>
                            @if($todo["status"]=="pending")
                                Pending
                            @endif

                            @if($todo["status"]=="accomplished")
                                Accomplished
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-primary"
                                    wire:click="$emitTo('todo-module-livewire.form-component', 'edit', {{ $todo['id'] }})">
                                Edit
                            </button>

                            @if($confirmingDeleteId === $todo['id'])
                                <button wire:click="delete({{ $todo['id'] }})" class="btn btn-outline-danger">Sure?</button>
                            @else
                                <button wire:click="confirmDelete({{ $todo['id'] }})"  class="btn btn-outline-danger">Delete</button>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No Tasks found.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>


    <div class="pagination-container">

    </div>

</div>

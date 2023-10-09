<form action="{{ route('admin.' . $model . '.single', $row->id) }}" method="GET">
    @csrf
    @method('GET')
    <button class="btn-sm btn-primary border-0" type="submit">
        {{ __('table.edit') }}
    </button>
</form>

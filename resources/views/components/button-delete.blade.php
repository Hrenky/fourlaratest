<form action="{{ route('admin.' . $model . '.delete', $row->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn-sm btn-danger border-0 delete-button" type="submit">
        {{ __('table.delete') }}
    </button>
</form>

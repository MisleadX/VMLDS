@if ($permission['show'])
    <a href="{{ route('admin.' . $thisRoute . '.show', $query->{$masterId}) }}" class="mb-1 btn btn-info btn-sm"
       title="@lang('general.show')">
        <i class="fa fa-eye"></i>
        <span class="d-none d-md-inline"> @lang('general.show')</span>
    </a>
    
    @if($query->status == 1)
        <a href="<?php echo route('admin.' . $thisRoute . '.read', $query->{$masterId}) ?>" class="mb-1 btn btn-success btn-sm" 
            title="@lang('general.mark_as_read')">
            <i class="fa fa-book"></i>
            <span class=""> @lang('general.mark_as_read')</span>
        </a>
     @endif
@endif
@if ($permission['edit'])
    <a href="{{ route('admin.' . $thisRoute . '.edit', $query->{$masterId}) }}" class="mb-1 btn btn-primary btn-sm"
       title="@lang('general.edit')">
        <i class="fa fa-pencil"></i>
        <span class="d-none d-md-inline"> @lang('general.edit')</span>
    </a>
@endif
@if ($permission['destroy'])
    <a href="#" class="mb-1 btn btn-danger btn-sm" title="@lang('general.delete')"
       onclick="return actionData('{{ route('admin.' . $thisRoute . '.destroy', $query->{$masterId}) }}', 'delete')">
        <i class="fa fa-trash"></i>
        <span class="d-none d-md-inline"> @lang('general.delete')</span>
    </a>
@endif

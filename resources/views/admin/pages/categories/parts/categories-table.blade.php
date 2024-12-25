<div class="col-12 col-md-7">
    <div class="bg-white p-2">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                <thead>
                    <tr>
                        <th>{{ __('translate.name') }}</th>
                        <th>{{ __('translate.image') }}</th>
                        <th>{{ __('translate.actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                @if (app()->getLocale() == 'ar')
                                    {{ $category->name }}
                                @else
                                    {{ $category->name }}
                                @endif
                            </td>
                            <td>

                                @if ($category->image)
                                    <img src="{{ asset('uploads/' . $category->image) }}" width="50px" />
                                @else
                                    <p>{{ __('translate.no-image') }}</p>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('translate.select-action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('edit.category', $category->id) }}">
                                            {{ __('translate.edit') }}
                                        </a>
                                        <a class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            href="{{ route('delete.category', $category->id) }}">
                                            {{ __('translate.delete') }}
                                        </a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
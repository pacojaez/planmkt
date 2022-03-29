<?php

namespace App\Http\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentTable extends Component
{

    use WithPagination;
    /**
     * Collection of contents
     *
     * @var Collection|null
     */
    protected ?LengthAwarePaginator $contents;

    public function paginationView()
    {
        return 'components.custom-pagination-links-view';
    }

    public function render()
    {
        $this->contents = Content::orderBy('publicationdate', 'Desc')->paginate(10);

        return view('livewire.content-table', [
            'contents' => $this->contents
        ]);
    }
}

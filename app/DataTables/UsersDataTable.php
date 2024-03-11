<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Console\Application;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('dibuat', function($data){
                return Carbon::parse($data->created_at)->diffForHumans(['parts' => 2, 'short' => true]);
            })
            ->editColumn('nama', function($data){
                $url_photo = "images/photo/$data->photo";
                return '<img src="'.asset($url_photo).'" class="img-fluid mr-1" width="50px" alt="photo_profile">'. ' '.$data->name;
            })
            ->editColumn('ttd', function($data){
                $url_photo = "ttd/$data->ttd";
                return '<img src="'.asset($url_photo).'" class="rounded" width="50px" alt="ttd_user">';
            })
            ->editColumn('role', function($data){
                return $data->roles->implode('name', ' ');
            })
            ->editColumn('unit', function($data){
                return $data->units == null ? '' : $data->units->nama;
            })
            ->editColumn('unit', function($data){
                return $data->units == null ? '' : $data->units->nama;
            })
            ->addColumn('action', function($data){
                $actionBtn = <<<EOL
                <div class="d-flex">
                    <button 
                        class="btn btn-outline-primary btn-sm"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top"
                        title="Reset Password"
                        data-id="$data->id"
                        id="btn-resetPassword"
                    ><i class="bi bi-arrow-counterclockwise"></i>
                    </button>

                    <button 
                        class="btn btn-outline-danger btn-sm ms-1"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top"
                        title="Nonaktifkan Akun"
                        data-id="$data->id"
                        id="btn-nonaktif"
                    >
                    <i class="bi bi-trash"></i></button>                
                </div>
                EOL;

                return $actionBtn;

            })
            ->rawColumns(['nama', 'ttd', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->with('roles')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->autoWidth(false)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->addClass('align-middle text-center'),
            Column::make('nama')->orderable(false)->searchable(false),
            // Column::make('ttd')->orderable(false),
            Column::make('email'),
            Column::make('dibuat')->orderable(false)->searchable(false),
            Column::make('role')->orderable(false)->searchable(false),
            // Column::make('unit')->orderable(false)->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}

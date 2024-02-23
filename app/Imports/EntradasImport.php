<?php

namespace App\Imports;

use App\Models\Detalle_movimientos;
use App\Models\Entradas;
use App\Models\Movimientos;
use App\Models\Productos;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EntradasImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function collection(Collection $rows)
    {
        $total = 0;

        foreach ($rows as $row) {
            $referencias = $row['referencia'];
            $descripcion = $row['descripcion'];
            $entrada = $row['cantidad'];
            $producto = Productos::all()->where('descripcion', $descripcion)->where('referencia', $referencias)->first();
            if ($producto != null) {
                $detallemovimiento = new Detalle_movimientos();
                $detallemovimiento->productos_id = $producto->id;
                $detallemovimiento->cantidad = $entrada;
                $detallemovimiento->movimiento_id = $this->id;
                $detallemovimiento->save();
                $producto->stock = $producto->stock + $entrada;
                $producto->save();
                $total = $total + $row['cantidad'];
            } else {
                $entrada = Movimientos::find($this->id);
                $entrada->delete();
                return redirect()->route('admin.salidas.index')->with('encontrado', 'no');
            }
        }
        $entrada = Movimientos::find($this->id);
        $entrada->cantidad = $total;
        $entrada->save();
        return null;
    }
}

<?php

namespace App\Imports;

use App\Models\Detalle_movimientos;
use App\Models\Movimientos;
use App\Models\Productos;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalidasImport implements ToCollection, WithHeadingRow
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
            $salida = $row['cantidad'];
            $producto = Productos::all()->where('descripcion', $descripcion)->where('referencia', $referencias)->first();
            if ($producto != null) {
                if ($producto->stock >= 0 && $producto->stock - $salida >= 0) {
                    $detallemovimiento = new Detalle_movimientos();
                    $detallemovimiento->productos_id = $producto->id;
                    $detallemovimiento->cantidad = $salida;
                    $detallemovimiento->movimiento_id = $this->id;
                    $detallemovimiento->save();
                    $producto->stock = $producto->stock - $salida;
                    $producto->save();
                    $total = $total + $row['cantidad'];
                } else {
                    $movimiento = Movimientos::find($this->id);
                    $movimiento->delete();
                    return redirect()->route('admin.salidas.index')->with('exedido', 'si');
                }
            } else {
                $movimiento = Movimientos::find($this->id);
                    $movimiento->delete();
                return redirect()->route('admin.salidas.index')->with('encontrado', 'no');
            }
        }
        $entrada = Movimientos::find($this->id);
        $entrada->cantidad = $total;
        $entrada->save();
        return null;
    }
}

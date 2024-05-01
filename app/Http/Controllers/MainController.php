<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Part;
use App\Models\Customer;
use App\Models\Rak;
use App\Models\PartCustomerRak;

class MainController extends Controller
{
    public function index()
    {
        $mains = Main::all();
        $raks = Rak::all();

        return view('main.index', compact('mains', 'raks'));
    }

    public function transaksi()
    {
        $mains = Main::all();
        
        return view('main.transaksi', compact('mains'));
    }
    

    public function create()
    {
        $parts = Part::all();
        $customers = Customer::all();
        $raks = Rak::all();
        $relations = PartCustomerRak::all();
    
        return view('main.create', compact('parts', 'customers', 'raks', 'relations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'part_id' => 'required',
            'customer_id' => 'required',
            'rak_id' => 'required',
            'shift' => 'required|in:A,B,C',
            'in' => 'required|integer|min:1|max:100',
            'out' => 'required|integer|min:1|max:100',
            'sisa' => 'required|integer|min:1|max:100',
            'pic' => 'required|in:MFG,QC',
            'pic_name' => 'required',
            'keterangan' => 'nullable',
        ]);
    
        $main = new Main;
        $main->part_id = $request->part_id;
        $main->customer_id = $request->customer_id;
        $main->rak_id = $request->rak_id;
        $main->shift = $request->shift;
        $main->in = $request->in;
        $main->out = $request->out;
        $main->sisa = $request->sisa;
        $main->pic = $request->pic;
        $main->pic_name = $request->pic_name ?: 'Default Name';
        $main->keterangan = $request->keterangan;
        $main->save();
    
        return redirect()->route('main.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $main = Main::findOrFail($id);
        return view('main.show', compact('main'));
    }
    

    public function edit(Main $main)
    {
        $parts = Part::all();
        $customers = Customer::all();
        $raks = Rak::all();
    
        return view('main.edit', compact('main', 'parts', 'customers', 'raks'));
    }

    public function update(Request $request, Main $main)
    {
        $validatedData = $request->validate([
            'part_id' => 'required',
            'customer_id' => 'required',
            'rak_id' => 'required',
            'shift' => 'required|in:A,B,C',
            'in' => 'required|integer|min:1|max:100',
            'out' => 'required|integer|min:1|max:100',
            'sisa' => 'required|integer|min:1|max:100',
            'pic' => 'required|in:MFG,QC',
            'pic_name' => 'required|string',
            'keterangan' => 'nullable',
        ]);
    
        $main->part_id = $validatedData['part_id'];
        $main->customer_id = $validatedData['customer_id'];
        $main->rak_id = $validatedData['rak_id'];
        $main->shift = $validatedData['shift'];
        $main->in = $validatedData['in'];
        $main->out = $validatedData['out'];
        $main->sisa = $validatedData['sisa'];
        $main->pic = $validatedData['pic'];
        $main->pic_name = $validatedData['pic_name'];
        $main->keterangan = $validatedData['keterangan'];
    
        $main->save();
    
        return redirect()->route('main.index')->with('success', 'Berhasil Diperbarui');
    }

    public function destroy(Main $main)
    {
        $main->delete();
        return redirect()->route('main.index')->with('success', 'Data berhasil dihapus');
    }
}

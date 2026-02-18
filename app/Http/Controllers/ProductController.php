<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Jobs\SendProductCreatedMail;
use App\Jobs\ImportProductsFromCsv;


class ProductController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $products = Product::query();

        // 🔍 Search Filter
        if ($request->filled('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        // 📦 Stock Filter
        if ($request->stock === 'in') {
            $products->where('stock', '>', 10);
        }

        if ($request->stock === 'low') {
            $products->whereBetween('stock', [1, 9]);
        }

        if ($request->stock === 'out') {
            $products->where('stock', 0);
        }

        $products = $products
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products'));
    }


    // ================= CREATE =================
    public function create()
    {
        return view('products.create');
    }


    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::create([
            'name'    => $request->name,
            'price'   => $request->price,
            'stock'   => $request->stock,
            'user_id' => 1 // temporary
        ]);

        // 🔥 Queue Job
        SendProductCreatedMail::dispatch($product);
        // SendProductCreatedMail::dispatch($product);
        // SendProductCreatedMail::dispatchSync($product);

        // dd('Controller reached');

        

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Created Successfully!');
    }


    // ================= SOFT DELETE =================
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product moved to Trash!');
    }


    // ================= TRASH LIST =================
    public function trash()
    {
        $products = Product::onlyTrashed()
            ->latest('id')
            ->paginate(8);

        return view('products.trash', compact('products'));
    }


    // ================= RESTORE =================
    public function restore($id)
    {
        Product::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
            ->route('products.trash')
            ->with('success', 'Product Restored Successfully!');
    }


    // ================= PERMANENT DELETE =================
    public function forceDelete($id)
    {
        Product::onlyTrashed()
            ->findOrFail($id)
            ->forceDelete();

        return redirect()
            ->route('products.trash')
            ->with('success', 'Product Permanently Deleted!');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->ids) {
            Product::whereIn('id', $request->ids)->delete();
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Selected products deleted successfully.');
    }


    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $path = $request->file('csv_file')->store('csv');

        ImportProductsFromCsv::dispatch($path);

        return back()->with('success', 'CSV is being processed in background.');
    }

    public function trashBulkAction(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if (!$ids) {
            return back()->with('error', 'No products selected.');
        }

        if ($action === 'restore') {
            Product::onlyTrashed()
                ->whereIn('id', $ids)
                ->restore();

            return back()->with('success', 'Selected products restored.');
        }

        if ($action === 'forceDelete') {
            Product::onlyTrashed()
                ->whereIn('id', $ids)
                ->forceDelete();

            return back()->with('success', 'Selected products permanently deleted.');
        }

        return back();
    }

}

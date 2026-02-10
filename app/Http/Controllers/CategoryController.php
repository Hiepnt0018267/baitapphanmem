<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::where('is_delete', 0)->with('parent')->get();
        return view('category.index', compact('categories'));
    }

    public function create() {
        $parents = Category::where('is_delete', 0)->get();
        return view('category.create', compact('parents'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Thêm thành công!');
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        $parents = Category::where('is_delete', 0)->where('id', '!=', $id)->get();
        return view('category.edit', compact('category', 'parents'));
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $request->validate(['name' => 'required', 'parent_id' => 'nullable|exists:categories,id']);

        if ($request->parent_id) {
            $childrenIds = $this->getAllChildrenIds($category);
            if (in_array($request->parent_id, $childrenIds) || $request->parent_id == $category->id) {
                return back()->withErrors(['parent_id' => 'Không thể chọn chính nó hoặc con cháu làm cha!']);
            }
        }

        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id) {
        Category::where('id', $id)->update(['is_delete' => 1]);
        return redirect()->route('category.index');
    }

    private function getAllChildrenIds($category) {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllChildrenIds($child));
        }
        return $ids;
    }
}
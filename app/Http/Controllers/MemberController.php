<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberCategory;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $categories = MemberCategory::all();
        $query = Member::orderBy('name');

        if ($request->has('category')) {
            $category = MemberCategory::where('slug', $request->query('category'))->first();
            if ($category) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('member_category_id', $category->id);
                });
            }
        }

        $members = $query->paginate(12);

        return view('members.index', compact(['members', 'categories']));
    }
}

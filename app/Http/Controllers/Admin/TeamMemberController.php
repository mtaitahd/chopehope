<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        return view('admin.team.index', ['members' => TeamMember::orderBy('sort_order')->orderBy('name')->paginate(20)]);
    }

    public function create() { return view('admin.team.form', ['member' => new TeamMember]); }
    public function edit(TeamMember $team) { return view('admin.team.form', ['member' => $team]); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['photo'] = $request->file('photo')?->storePublicly('uploads/team', 'public');
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('status', 'Team member added.');
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $this->validated($request);
        unset($data['photo']);
        $oldPhoto = $team->photo;
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->storePublicly('uploads/team', 'public');
        elseif ($request->boolean('remove_photo')) $data['photo'] = null;
        $team->update($data);
        if ($oldPhoto && $team->photo !== $oldPhoto) Storage::disk('public')->delete($oldPhoto);
        return redirect()->route('admin.team.index')->with('status', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        $photo = $team->photo;
        $team->delete();
        if ($photo) Storage::disk('public')->delete($photo);
        return redirect()->route('admin.team.index')->with('status', 'Team member removed.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:160'],
            'bio' => ['nullable', 'string', 'max:3000'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['nullable', 'boolean'],
            'remove_photo' => ['nullable', 'boolean'],
        ]);
        unset($data['remove_photo']);
        $data['is_published'] = $request->boolean('is_published');
        return $data;
    }
}

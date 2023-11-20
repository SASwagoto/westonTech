<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Site::firstOrFail();
       return view('settings.site', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $settings = Site::findOrFail($site->id);

        // Update fields from the form
        $settings->update([
            'app_title' => $request->input('app_title'),
            'company_name' => $request->input('company_name'),
            'company_email' => $request->input('company_email'),
            'company_phone' => $request->input('company_phone'),
            'footer_title' => $request->input('footer_title'),
            'about_us' => $request->input('about_us'),
            'footer_url' => $request->input('footer_url'),
            'fb_url' => $request->input('fb_url'),
            'linkedin_url' => $request->input('linkedin_url'),
            'twitter_url' => $request->input('twitter_url'),
            'insta_url' => $request->input('insta_url'),
        ]);
    
        // Handle image uploads
        if ($request->hasFile('app_logo')) {
            $image = $request->file('app_logo');
            $imageName = time() . 'app_logo.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/site'), $imageName);
    
            // Save the image name to the database
            $settings->app_logo = $imageName;
        }
    
        if ($request->hasFile('fav_icon')) {
            $image = $request->file('fav_icon');
            $imageName = time() . 'fav_icon.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/site'), $imageName);
    
            // Save the image name to the database
            $settings->fav_icon = $imageName;
        }
    
        // Save the updated settings
        $settings->save();
    
        Alert::success('Success', 'Update Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}

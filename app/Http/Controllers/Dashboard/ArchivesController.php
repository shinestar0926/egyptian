<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Archives;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use Imagick;


class ArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $archives = Archives::when($request->search, function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
                });
        })->latest()->paginate(8);



        return view('dashboard.archives.index', compact('archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.archives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'description' => 'required',
            'title' => 'required',
        ];
        $request->validate($rules);
        $request_data= $request->all();
        if ($request->pdf) {
            $file = $request->file('pdf');
            $filename = time() . '.' . $request->file('pdf')->extension();
            $filePath = public_path('uploads/archives/');
            $file->move($filePath, $filename);
          
            $request_data['pdf'] = $filename;
         
        
/*
            // Create the Ghostscript-Wrapper
$pathToPdf=public_path().'/img/documents/newpdffile1.pdf';
        $pathToWhereImageShouldBeStored=public_path().'/img/output/rashid%d.png';
        Ghostscript::setGsPath("C:/Program Files/gs/gs9.26/bin/gswin64c.exe");
        $pdf = new Pdf($pathToPdf);
        $pdf->setOutputFormat('png')->saveImage($pathToWhereImageShouldBeStored);



*/












         //   $pdf = new Pdf($filePath);
           // $pdf->setPage(1)->setOutputFormat('png')->saveImage($filePath);
          
            
        }
//dd(Ghostscript::getGsPath() );
       

    
        Archives::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.archives.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archive=Archives::where('id',$id)->first();
        
        return view('dashboard.archives.edit', compact('archive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'description' => 'required',
            'title' => 'required',
        ];
        $request->validate($rules);
        $request_data= $request->all();
        if ($request->pdf) {
            $file = $request->file('pdf');
            $filename = time() . '.' . $request->file('pdf')->extension();
            $filePath = public_path('uploads/archives/');
            $file->move($filePath, $filename);
          
            $data['pdf'] = $filename;
        }

        $data['description'] = $request['description'];
        $data['title'] = $request['title'];

        Archives::where('id', $id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.archives.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Archives::where('id',$id)->delete();
       
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.archives.index');
    }
}

<?php






/*** helpers functions ***/


/**
 * Return current auth user
 * @return \App\Models\User $object
*/


if ( !function_exists('user') )
{
	function user()
	{
		return auth()->user();
	}
}



if ( !function_exists('aurl') )
{

	/**
	* Get route of dashboard
	* @param $url name after prefix admin
	* @return void
	*/

	function aurl($url = null)
	{
		return url('admin') . '/' . $url;
	}

}


if ( !function_exists('is_active') )
{
	/**
	* Add class active to dashboard sidebar
	* @param string $segment 
	* @return string
	*/

	function is_active($segment=null)
	{
		if ( request()->segment(2) == 'admin' and request()->segment(3) == $segment )
		{
			return 'is-expanded';
		}


		return null;
	}

}

if ( !function_exists('auth_admin') )
{
	/**
	* Get auth admin from admin table
	* @return object
	*/
	function auth_admin()
	{
		return auth()->guard('admin')->user();
	}

} 

if ( !function_exists('setting') )
{

	/**
	* Get global settings of site 
	* @return object
	*/

	function setting()
	{
		return \App\Models\Setting::orderBy('id','desc')->first();
	}

} 


if ( !function_exists('check_default') )
{
	/**
	* Check if given path contains default keyword
	* @param string $path
	* @return boolean
	*/

	function check_default($path)
	{
	   
	   return preg_match('/default/', $path);

	} 
}

if ( !function_exists('upload') )
{
	/**
	* Upload Image and resize it and return by path of it 
	* @param string $file_name from $request
	* @param string $directory to store file in 
	* @param int $width 
	* @param int $height
	* @param string $old to delete old one if exists 
	* @return string $path to save in DB
	*/
	function upload($file_name,$directory,$width,$height,$old=null)
	{
			if ( $old !== null and check_default($old) == 0 )
			{
				Storage::has($old) ? Storage::delete($old) : '';
			}
		    $path = request($file_name)->store($directory);
            $img = Image::make('storage/'.$path);
            $img->resize($width,$height)->save();

            return $path;

	} 
}






if ( !function_exists('create_unique_slug') )
{

	/**
	* Create unique slug to avoid dublicate slug 
	* @param string $title ( Slug convert from )
	* @param string $modelName ( To check of slug exists  )
	* @return string $slug
	*/

	function create_unique_slug($title,$modelName)
	{

		$slug = Str::slug($title);

		$original = $slug;

		$num = 2;

		while( $modelName::whereSlug($slug)->exists() )
		{
			$slug = $original . '-' . $num++;
		}

		return $slug;


	}  
}




if ( !function_exists('sidebarLinks') )
{
	/**
	* Sidebar names of dashboard to loop through  
	* @return array
	*/
	
	function sidebarLinks()
	{
		$links = 
		[
			'admins'       => 'fa-user',
		    'users'        => 'fa-users',
		    'types'        => 'fa-sort',
		    'countries'    => 'fa-flag',
		    'skills'       => 'fa-bolt',
		    'tags'         => 'fa-tags',
		    'categories'   => 'fa-th-list',
		    'posts'        => 'fa-paragraph',
		    'comments'     => 'fa-comments-o',
			'jobs'         => 'fa-money',
			'testimonials' => 'fa-quote-left'
		];

		return $links;

	} 
}



if ( !function_exists('check_file') )
{
	/**
	* Check if file exist true ? delete it 
	* @param string $file
	* @return void
	*/

	function check_file($file)
	{
		if ( Storage::has($file) and check_default($file) == 0 )
		{
			Storage::delete($file);
		}

		return "";
	}
}



if ( !function_exists('get_reading_time') )
{
 /**
 * Returns an estimated reading time in a string
 * @param  string $content the content to be read
 * @return string estimated read time 
 */
function get_reading_time($content) 
{
    $word_count = str_word_count(strip_tags($content));

    $minutes = floor($word_count / 200);


    if ($minutes == 0) {

        return "1 minute";
    }
    else {

        return "{$minutes} minutes";
    }
}
}




if ( !function_exists('draw_chart') )
{
	function draw_chart($chartClass,$labels=[],$data=[],$type='bar',$title='Chart Title')
	{
		$chart = new $chartClass;

		$chart->labels($labels);

		$dataset = $chart->dataset($title,$type,$data)->options([

			'fill' => 'true',
            'borderColor' => '#51C1C0',

		]);

		if ( $type !== 'bar' and $type !== 'line' )
		{
			$dataset->backgroundColor(collect(['#46BFBD','#F7464A','#FDB45C']));
		}


		return $chart;
	}
}





if ( !function_exists('get_months') )
{
	function get_months()
	{
		$monthsNums  = collect(range(1,12));
        $monthsNames = collect(["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"]);
        $months = $monthsNums->combine($monthsNames); 

		return $months;
	}
}










/*** helpers functions ***/
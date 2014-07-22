/**
 *	jSort
 *	Author: John Gardner (http://www.artofalhadis.com/)
 *	Version: 1.0
 *
 *	Dual licensed under the MIT and GPL licenses
 */
(function($){

	//	Instanced Methods
	$.fn.extend({
		jSort	:	function(options){
			return this.each(function(){


				//	Declare default option values
				var args	=	jQuery.extend({

					/**	Specifies which items inside the element should be sorted. */
					items:			'> *',


					/**
						Function that returns the value to sort each list item by. Defaults to the item's inner text ($.fn.html).
						
						A custom function may be passed in to handle more advanced or complicated calculations. For example, to sort
						a list of items with dates in "April 15th" format, a function might have custom date parsing code to return a UNIX
						timestamp. Additional arguments can be passed to the function through use of the .extraArgs parameter (see below).
						
						Alternatively, an HTML attribute of the queried item can be used instead by passing in a string value instead of a function.
						For example, passing in a value of "title" is analoguous to calling .attr("title").
					*/
					queryFunc:		$.fn.html,


					/**	If passed a selector, will sort each item by evaluating the matching child, rather than the item itself. */
					queryChild:		false,


					/**	An object with values to pass to queryFunc. */
					extraArgs:		null,


					/**	If set, lists will be sorted in descending (reverse) order. */
					descending:		false,


					/**
						Whether to place unsorted items before or after sorted items.
						
						Defaults to TRUE, meaning unsorted objects (those not matching the .items selector) are left at the top of
						the containing element, with the arranged items inserted after.
					*/
					insertAfter:	true

				}, options);


				var _this		=	$(this);				


				//	Run a quick hack; apparently jQuery's children() function gets confused by "> *" selectors.
				if(args.items == "> *" || args.items == ">*")
					args.items	=	null;


				//	List of items collected in each containing element's DOM list
				var items		=	_this.children(args.items);


				//	Whether or not queryFunc value is a string (saves checking types in the loop)
				var _attr		=	(typeof args.queryFunc == "string") ? args.queryFunc : null;


				var f1, f2, _a, _b, v1, v2;
				items.sort(function(a, b){

					if(args.queryChild){
						_a	=	$(a).find(args.queryChild);
						_b	=	$(b).find(args.queryChild);
					}

					else{
						_a	=	$(a);
						_b	=	$(b);
					}


					if(_attr){
						v1	=	_a.attr(args.queryFunc);
						v2	=	_b.attr(args.queryFunc);
					}
					else if(args.extraArgs){
						v1	=	args.queryFunc.call(_a, args.extraArgs);
						v2	=	args.queryFunc.call(_b, args.extraArgs);
					}
					else{
						v1	=	args.queryFunc.call(_a);
						v2	=	args.queryFunc.call(_b);
					}


					f1	=	parseFloat(v1);
					f2	=	parseFloat(v2);
					if(f1 == v1)	v1	=	f1;
					if(f2 == v2)	v2	=	f2;

					if(v1 == v2)	return 0;
					else			return (args.descending ? (v1 < v2 ? 1:-1):(v1 < v2 ? -1:1));
				});

				items.detach();
				if(args.insertAfter)	_this.append(items);
				else					_this.prepend(items);
			});
		}
	});


	//	Static Methods
	$.jSort	=	function jSort(target, options){
		return target.jSort(options);
	};

})(jQuery);
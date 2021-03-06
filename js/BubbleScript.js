/*

	Bubble color picker
	By @Lewitje

	Have fun with it!

*/
var colorPicker = (function(){
	
	var config = {
		baseColors: [
			[205, 92, 92],
			[226, 114, 91],
			[213, 100, 90],
			[230, 99, 70],
			[210, 80, 66],
			[230, 119, 84],
			[231, 76, 60]
		],
		lightModifier: 20,
		darkModifier: 0,
		transitionDuration: 200,
		transitionDelay: 25,
		variationTotal: 10,
		showVariants: false,
		responseFunc: null
	};
	
	var state = {
		activeColor: [0, 0, 0]
	};
	
	function init(baseColors, activeColor, functionResponse){
		if(baseColors !== undefined && baseColors !== null){
			config.baseColors = baseColors;
		}
		if(activeColor !== undefined && activeColor !== null){
			state.activeColor = activeColor;
		}else{
			state.activeColor = [0,0,0];
		}
		if(functionResponse !== undefined && functionResponse !== null){
			config.responseFunc = functionResponse;
		}else{
			config.responseFunc = null;
		}
		createColorPicker(function(){
			appendBaseColors();
		});
		addEventListeners();
		if(functionResponse !== undefined && functionResponse !== null && activeColor !== undefined && activeColor !== null){
			functionResponse(activeColor);
		}
		if(activeColor !== undefined && activeColor !== null && config.showVariants){
			console.log(activeColor);
			hideVariations(function(){
				createVariations(activeColor, function(){
					setDelays(function(){
						showVariations();
					});
				});
			});
		}
	}
	
	function setActiveBaseColor(el){
		$('.color.active').removeClass('active');
		el.addClass('active');
	}
	
	function setActiveColor(el){
		$('.color-var.active').removeClass('active');
		el.addClass('active');
		state.activeColor = el.data('color').split(',');
	}
	
	function addEventListeners(){
		$('body').on('click', '.color', function(){
			var color = $(this).data('color').split(',');
			if(config.responseFunc !== null && config.responseFunc !== undefined){
				config.responseFunc(color);
			}
			if(config.showVariants){
				hideVariations(function(){
					createVariations(color, function(){
						setDelays(function(){
							showVariations();
						});
					});
				});
			}
			setActiveBaseColor($(this));
		});
		
		$('body').on('click', '.color-var', function(){
			setActiveColor($(this));
			//setBackgroundColor();
		});
	}
	
	function setFirstColorActive(callback){
		$('.color').eq(1).trigger('click');
		callback();
	}
	
	function setFirstModifiedColorActive(){
		setTimeout(function(){
			$('.color-var').eq(7).trigger('click');
		}, 500);
	}
	
	function createColorPicker(callback){
		$('.color-picker').append('<div class="base-colors"></div>');
		$('.color-picker').append('<div class="varied-colors"></div>');
		$('.color-picker').append('<div class="active-color"></div>');
		$('.color-picker').append('<div class="color-history"></div>');
		
		callback();
	}
	
	function appendBaseColors(){
		for(i = 0; i < config.baseColors.length; i++){
			if(state.activeColor.join() == config.baseColors[i].join()){
				$('.base-colors').append('<div class="color active" data-color="' + config.baseColors[i].join() + '" style="background-color: rgb(' + config.baseColors[i].join() + ');"></div>');
			}else{
				$('.base-colors').append('<div class="color" data-color="' + config.baseColors[i].join() + '" style="background-color: rgb(' + config.baseColors[i].join() + ');"></div>');
			}
		}
	};
	
	function setBackgroundColor(){
		$('body').css({
			'background-color': 'rgb(' + state.activeColor + ')'
		});
	}
	
	function createVariations(color, callback){
		$('.varied-colors').html('');
		
		for(var i = 0; i < config.variationTotal; i++){
			var newColor = [];
			
			for (var x = 0; x < color.length; x++){
				var modifiedColor = (Number(color[x]) - 100) + (config.lightModifier * i);
				
				if(modifiedColor <= 0){
					modifiedColor = 0;
				} else if (modifiedColor >= 255){
					modifiedColor = 255;
				}
				
				newColor.push(modifiedColor);
			}
			
			$('.varied-colors').append('<div data-color="' + newColor + '" class="color-var" style="background-color: rgb(' + newColor + ');"></div>');
		}
		
		callback();
	}
	
	function setDelays(callback){
		$('.color-var').each(function(x){
			$(this).css({
				'transition': 'transform ' + (config.transitionDuration / 1000) + 's ' + ((config.transitionDelay / 1000) * x) + 's'
			});
		});
		
		callback();
	}
	
	function showVariations(){
		setTimeout(function(){
			$('.color-var').addClass('visible');
		},(config.transitionDelay * config.variationTotal));
	}
	
	function hideVariations(callback){
		$('.color-var').removeClass('visible').removeClass('active');
		
		setTimeout(function(){
			callback();
		},(config.transitionDelay * config.variationTotal));
	}
	
	return{
		init: init
	};
	
}());
/*------------------------------------------------------------------
Project:        Modus - HTML onepage theme by GraphBerry.com
Version:        1.0
Last change:    12/06/2017
Author:         GraphBerry
URL:            http://graphberry.com
License:        http://graphberry.com/pages/license
-------------------------------------------------------------------*/
$(function(){
	'use strict';



var slideConts = document.querySelectorAll('.slideConts'); // �X���C�h�ŕ\��������v�f�̎擾
var slideContsRect = []; // �v�f�̈ʒu�����邽�߂̔z��
var slideContsTop = []; // �v�f�̈ʒu�����邽�߂̔z��
var windowY = window.pageYOffset; // �E�B���h�E�̃X�N���[���ʒu���擾
var windowH = window.innerHeight; // �E�B���h�E�̍������擾
var remainder = 100; // ������Ƃ͂ݏo�����镔��
// �v�f�̈ʒu���擾
for (var i = 0; i < slideConts.length; i++) {
  slideContsRect.push(slideConts[i].getBoundingClientRect());
}
for (var i = 0; i < slideContsRect.length; i++) {
  slideContsTop.push(slideContsRect[i].top + windowY);
}
// �E�B���h�E�����T�C�Y���ꂽ��A�E�B���h�E�̍������Ď擾
window.addEventListener('resize', function () {
  windowH = window.innerHeight;
});
// �X�N���[�����ꂽ��
window.addEventListener('scroll', function () {
  // �X�N���[���ʒu���擾
  windowY = window.pageYOffset;
  
  for (var i = 0; i < slideConts.length; i++) {
    // �v�f����ʂ̉��[�ɂ���������
    if(windowY > slideContsTop[i] - windowH + remainder) {
      // .show��t�^
      slideConts[i].classList.add('show');
    } else {
      // �t��.show���폜
      slideConts[i].classList.remove('show');
    }
  }
});




	/*--------------------------------------------------
    Scrollspy Bootstrap 
    ---------------------------------------------------*/

    $('body').scrollspy({
    	target: '#header',
    	offset: 100
    });


	/*--------------------------------------------------
    Smooth Scroll 
    ---------------------------------------------------*/

	smoothScroll.init({
		selector: '.smoothScroll',
		speed: 1000,
		offset: 100,
		before: function(anchor, toggle){
			// Check if mobile navigation is active
			var query = Modernizr.mq('(max-width: 767px)');
			// Check if element is navigation eelement
			var navItem = $(toggle).parents("#main-navbar").length;
			// If mobile nav & nav item then close nav
			if (query && navItem !== 0) {
				$("button.navbar-toggle").click();
			}
		}
	});


	/*--------------------------------------------------
    Mixitup
    ---------------------------------------------------*/

    var mixer = mixitup('#portfolio-grid', {

		selectors: {
			control: '[data-mixitup-control]'
		}
		
	});


	/*--------------------------------------------------
    Slick Slider
    ---------------------------------------------------*/

	$('.slider-container').slick({
		arrows: false,
		autoplay: true,
		centerMode: true,
		centerPadding: '100px',
		variableWidth: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					centerMode: false,
					variableWidth: false
				}
			}
		]
	});


	/*--------------------------------------------------
    Porfolio cursor
    ---------------------------------------------------*/

	$('.team-member').on('mousedown', function() {
	    $(this).removeClass('grabbable');
	    $(this).addClass('grabbing');
	});

	$('.team-member').on('mouseleave mouseup', function() {
	    $(this).removeClass('grabbing');
	    $(this).addClass('grabbable');
	});

	/*--------------------------------------------------
    Current Year
    ---------------------------------------------------*/

    // Automatically update copyright year in the footer
	var currentTime = new Date();
	var year = currentTime.getFullYear();
	$("#year").text(year);


});

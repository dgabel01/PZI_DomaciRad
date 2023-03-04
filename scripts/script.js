const heartIcons = document.querySelectorAll('.heart-icon');
for (let i = 0; i < heartIcons.length; i++)
{
	const heartIcon = heartIcons[i];
	heartIcon.addEventListener('click', handleHeartIconClick);
}

async function handleHeartIconClick(e)
{
	const heartIcon = e.currentTarget;

	const post = heartIcon.closest('.users-post');
	const postId = post.getAttribute('data-post-id');

	const isCurrentlyLiked = heartIcon.classList.contains('fa-heart');
	try
	{
		const serverResponse = await fetch(
			`API.php?action=togglePostLike&id=${postId}&liked=${isCurrentlyLiked ? 0 : 1}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success)
		{
			throw new Error(`Error liking post: ${responseData.reason}`);
		}

		if (!isCurrentlyLiked)
		{
			heartIcon.classList.remove('fa-heart-o');
			heartIcon.classList.add('fa-heart');
		} else
		{
			heartIcon.classList.remove('fa-heart');
			heartIcon.classList.add('fa-heart-o');
		}
	} catch (error)
	{
		throw new Error(error.message || error);
	}
}

const bookmarkIcons = document.querySelectorAll('.bookmark-icon');
for (let i = 0; i < bookmarkIcons.length; i++)
{
	const bookmarkIcon = bookmarkIcons[i];
	bookmarkIcon.addEventListener('click', handleBookmarkIconClick);
}

async function handleBookmarkIconClick(e)
{
	const bookmarkIcon = e.currentTarget;

	const post = bookmarkIcon.closest('.users-post');
	const postId = post.getAttribute('data-post-id');

	const isCurrentlyBookmarked = bookmarkIcon.classList.contains('fa-bookmark');
	try
	{
		const serverResponse = await fetch(
			`API.php?action=togglePostBookmark&id=${postId}&bookmarked=${isCurrentlyBookmarked ? 0 : 1}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success)
		{
			throw new Error(`Error bookmarking post: ${responseData.reason}`);
		}

		if (!isCurrentlyBookmarked)
		{
			bookmarkIcon.classList.remove('fa-bookmark-o');
			bookmarkIcon.classList.add('fa-bookmark');
		} else
		{
			bookmarkIcon.classList.remove('fa-bookmark');
			bookmarkIcon.classList.add('fa-bookmark-o');
		}
	} catch (error)
	{
		throw new Error(error.message || error);
	}
}

const addPostButton = document.querySelector('#new-post-button');
console.log(addPostButton);
// Arrow function, runs when user clicks on addCardButton
addPostButton.addEventListener('click', async (e) =>
{
    const description = document.querySelector('#new-post-text').value;
    const image = document.querySelector('#new-post-image').value;

	try
	{
		const serverResponse = await fetch(`API.php?action=addPost&username=${'User1'}&imageUrl=${image}&description=${description}`);
		const responseData = await serverResponse.json();
		if (!responseData.success)
		{
			throw new Error(`Error while adding post: ${responseData.reason}`);
		}

		const postTemplate = document.querySelector('#post-template');
		if (responseData.id)
		{
			postTemplate.setAttribute('data-post-id', responseData.id);
		}
		// Creates an element based on template
		const postElement = document.importNode(postTemplate.content, true);

        const postImage = postElement.querySelector('.posted-image');
        const userImage = postElement.querySelector('.user-img');
        const descriptionContainer = postElement.querySelector('.user-comment');
		// Fill the created card with content
		postImage.querySelector('img').src = image;
		userImage.querySelector('img').src = image;
		descriptionContainer.querySelector('p').textContent = description;

		// add event listeners to necessary places
		postElement.querySelector('.heart-icon').addEventListener('click', handleHeartIconClick);
		postElement.querySelector('.bookmark-icon').addEventListener('click', handleBookmarkIconClick);

		// Add the card to the DOM in the card container
		const postsContainer = document.querySelector('.posts');

		postsContainer.prepend(postElement);
	}
	catch (error) 
	{
		throw new Error(error.message || error);
	}

});

// /* Implement search */
// document.querySelector('#search-box').addEventListener('keyup', (e) =>
// {
// 	// Get the value that is currently in the search input
// 	const query = e.currentTarget.value;

// 	// Get all cards and iterate through them
// 	const cards = document.querySelectorAll('.card');
// 	for (let i = 0; i < cards.length; i++)
// 	{
// 		const card = cards[i];
// 		if (card.textContent.indexOf(query) >= 0)
// 		{
// 			// does the card have the value that is in the input
// 			card.classList.remove('hidden');
// 		} else
// 		{
// 			// if it doesn't hide it
// 			card.classList.add('hidden');
// 		}
// 	}
// });

// /* Implement clicking and filling stars */
// const starElements = document.querySelectorAll('.card .star-icon');

// for (let i = 0; i < starElements.length; i++)
// {
// 	const starElement = starElements[i];
// 	starElement.addEventListener('click', handleStarClick);
// }

// async function handleStarClick(e)
// {
// 	const star = e.currentTarget;
// 	const starContainer = star.parentElement;
// 	const starSiblings = starContainer.children;
// 	const starIndex = star.getAttribute('star-index');
// 	const card = star.closest('.card');
// 	const cardId = card.getAttribute('data-card-id');
// 	try
// 	{
// 		const serverResponse = await fetch(`API.php?action=toggleStar&id=${cardId}&starIndex=${starIndex}`);
// 		const responseData = await serverResponse.json();
// 		let clickedStarPassed = false;
// 		for (let i = 0; i < starSiblings.length; i++)
// 		{
// 			const currentStar = starSiblings[i];
// 			if (!clickedStarPassed)
// 			{
// 				currentStar.classList.remove('fa-star-o');
// 				currentStar.classList.add('fa-star');
// 			} 
// 			else
// 			{
// 				currentStar.classList.remove('fa-star');
// 				currentStar.classList.add('fa-star-o');
// 			}
// 			if (currentStar == star)
// 			{
// 				clickedStarPassed = true;
// 			}
// 		}
// 	}
// 	catch(error)
// 	{
// 		throw new Error(error.message || error);
// 	}
// }

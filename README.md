Meal Planner

Problem:
It's always hard to know what's the right food to eat and when. Planning and organizing them in advance sometimes becomes a nightmare.

 

Solution:
A Meal Planner Web application that can help organizing and choosing meals for a short period of time (a week frame for example). It would as well help organizing the food shopping list for those meals.

Need to have:


    User:
    Create, delete and update their own recipes. The user can see other users' recipes too, but not delete or update them.
    Choose/update the dates and time for their own meals.


    Admin
    Perform the CRUD for all recipes.
    
    -> Perform the CRUD for all users including blocking them.


    Login System
    There should be only one ADMIN created when the application is created. Every other user that registers should be an ordinary user.


Recipes
    Should have enough information to help the user to prepare their meals. Ingredients, meal description, cooking preparation time and calories.
    
    -> It could as well have only a link to an online recipe or book.
    -> Filter: Vegan and vegetarian options should be easily selectable.


MealPlanner
    A CRUD where the user can choose between all available meals, pick a date and time and add them to the planner. The planner should be daily or weekly.
    There should be a filter to help the user to find the recipes by type (vegetarian, vegan... ), calories, etc...


Nice to have:

    Recipe rating
    Allergens
    Nutrients table
    Admin should approve the recipes before they are available to all users. When the admin accesses the control panel there should be a notification of a new recipe.
    Shopping list CRUD: the user could have the opportunity to make a list of the ingredients for the chosen recipes. Once it's done, the list is created and "closed". The list with their ingredients should be available for future access.

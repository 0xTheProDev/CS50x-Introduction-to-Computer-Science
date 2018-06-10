#include <cs50.h>
#include <stdio.h>
#include <math.h>

/*
    The Quarter = $ 0.25
    The Dime = $ 0.10
    The Nickel = $ 0.05
    The Penny = $ 0.01
*/

int main(void)
{
    float inp;
    int count = 0, arr[]={25, 10, 5, 1}, i = 0, cent;
    printf("O hai! How much change is owed?\n");
    inp = GetFloat();
    while(inp<=0)
    {
        printf("How much change is owed?\n");
        inp = GetFloat();
    }
    cent = round(inp * 100);
    while(cent != 0)
    {
        count += cent/arr[i];
        cent = cent%arr[i];
        i++;
    }
    printf("%i\n",count);
}
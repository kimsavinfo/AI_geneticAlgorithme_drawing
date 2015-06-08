using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace IAGenetic_DrawingMuse.Genetic
{
    class Population
    {
        protected int width;
        protected int height;
        protected IndividualColor[] individuals;

        public IndividualColor[] GetIndividuals()
        {
            return individuals;
        }

        public int GetWitdh()
        {
            return width;
        }

        public int GetHeight()
        {
            return height;
        }
    }
}
